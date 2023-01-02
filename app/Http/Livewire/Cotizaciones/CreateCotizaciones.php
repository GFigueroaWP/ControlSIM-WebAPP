<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Producto;
use App\Models\Proyecto;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateCotizaciones extends Component
{
    use WireToast;

    public $clientes;
    public $cot_cliente, $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli, $producto_id2;
    public $cotizacionItems = [];
    public $allProductos;
    public $total, $subtotal, $iva;

    public $listeners = ['fillCLiente'];

    public function mount(){
        $this->allProductos = Producto::all();
        $this->clientes = Cliente::all();
        $this->subtotal = 0;
        $this->total = 0;
        $this->iva = 0;
    }

    public function render()
    {
        return view('livewire.cotizaciones.create-cotizaciones',[
            'subtotal' => $this->subtotal,
            'total' => $this->total
        ]);
    }

    public function fillCliente(){
        $this->seleccionado = Cliente::findOrFail($this->select_id);
        $this->fill(['rut_cli'=> $this->seleccionado->cli_rut,
        'razon_cli'=> $this->seleccionado->cli_razonsocial,
        'giro_cli'=> $this->seleccionado->cli_giro,
        'direccion_cli'=> $this->seleccionado->cli_direccion]);
    }

    public function addProduct(){
        foreach($this->cotizacionItems as $key => $cotizacionItem){
            if(!$cotizacionItem['is_saved']){
                $this->addError('cotizacionItems'.$key, 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }
        }
        $this->cotizacionItems[] = [
            'producto_id' => '',
            'cantidad' => 1,
            'is_saved' => false,
            'prod_nombre' => '',
            'prod_valor' => 0
        ];

        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function editProduct($index){
        foreach($this->cotizacionItems as $key => $cotizacionItem){
            if(!$cotizacionItem['is_saved']){
                $this->addError('cotizacionItems'.$key, 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }
        }
        $this->cotizacionItems[$index]['is_saved'] = false;
    }

    public function saveProduct($index){
        $this->resetErrorBag();
        $this->cotizacionItems[$index]['producto_id'] = $this->producto_id2;

        $producto = $this->allProductos->find($this->cotizacionItems[$index]['producto_id']);
        $this->cotizacionItems[$index]['prod_nombre'] = $producto->prod_nombre;
        $this->cotizacionItems[$index]['prod_valor'] = $producto->prod_valor;
        $this->cotizacionItems[$index]['is_saved'] = true;

        $this->subtotal += $producto->prod_valor * $this->cotizacionItems[$index]['cantidad'];
        $this->iva = $this->subtotal * 0.19;
        $this->total = $this->iva + $this->subtotal;

    }

    public function removeProduct($index){
        $this->subtotal -= $this->cotizacionItems[$index]['prod_valor'] * $this->cotizacionItems[$index]['cantidad'];
        $this->iva = $this->subtotal * 0.19;
        $this->total = $this->iva + $this->subtotal;

        unset($this->cotizacionItems[$index]);
        $this->cotizacionItems = array_values($this->cotizacionItems);
    }


    public function submitCotizacion(){
        $this->validate();

        $items = [];

        foreach ($this->cotizacionItems as $item){
            $items[$item['producto_id']] = ['cantidad' => $item['cantidad']];
        }

        $pr_creado = Proyecto::create();

        $cot_creado = Cotizacion::create([
            'cli_id' => $this->seleccionado->id,
            'pr_id' => $pr_creado->id,
            'cot_directorio' => 'prueba',
            'cot_subtotal' => $this->subtotal,
            'cot_total' => $this->total
        ]);

        $pr_creado->cot_id = $cot_creado->id;
        $pr_creado->save();

        $cot_creado->productos()->sync($items);

        toast()->success('cotizacion añadida con éxito!')->pushOnNextPage();
        return redirect()->route('cotizaciones');
    }

    protected $rules = [
        'seleccionado.id' => 'required'
    ];
}
