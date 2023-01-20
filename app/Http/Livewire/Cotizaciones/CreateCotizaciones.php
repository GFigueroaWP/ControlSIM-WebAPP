<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Producto;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateCotizaciones extends Component
{
    use AuthorizesRequests;
    use WireToast;

    public $clientes;
    public $cot_cliente, $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli, $producto_id2;
    public $cotizacionItems = [];
    public $allProductos;
    public $total, $subtotal, $iva;

    protected $listeners = ['fillCLiente'];

    public function mount(){
        $this->authorize('viewAny', Cotizacion::class);
        $this->allProductos = Producto::all();
        $this->clientes = Cliente::all();
        $this->subtotal = 0;
        $this->total = 0;
        $this->iva = 0;
    }

    public function render()
    {
        $this->subtotal = 0;
        $this->iva = 0;
        $this->total = 0;

        foreach($this->cotizacionItems as $item){
            $this->subtotal += $item['prod_valor'] * $item['cantidad'];
        }

        $this->iva = $this->subtotal * 0.19;
        $this->total = $this->iva + $this->subtotal;

        $this->subtotal = '$'.number_format($this->subtotal,0,",",".");
        $this->iva = '$'.number_format($this->iva,0,",",".");
        $this->total = '$'.number_format($this->total,0,",",".");

        return view('livewire.cotizaciones.create-cotizaciones',[
            'subtotal' => $this->subtotal,
            'subtotal' => $this->iva,
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
        foreach($this->cotizacionItems as $index => $cotizacionItem){
            if(!$cotizacionItem['is_saved']){
                $this->addError('cotizacionItems'.$index.'producto_id', 'Esta linea debe ser guardada antes de añadir otro elemento');
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
                $this->addError('cotizacionItems'.$index, 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }

        }
        $this->cotizacionItems[$index]['is_saved'] = false;
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function saveProduct($index){
        $this->resetErrorBag();
        $this->cotizacionItems[$index]['producto_id'] = $this->producto_id2;

        $producto = $this->allProductos->find($this->cotizacionItems[$index]['producto_id']);
        $this->cotizacionItems[$index]['prod_nombre'] = $producto->prod_nombre;
        $this->cotizacionItems[$index]['prod_valor'] = $producto->prod_valor;
        $this->cotizacionItems[$index]['is_saved'] = true;
    }

    public function removeProduct($index){
        unset($this->cotizacionItems[$index]);
        $this->cotizacionItems = array_values($this->cotizacionItems);
    }


    public function submitCotizacion(){
        $this->validate();

        $items = [];

        foreach ($this->cotizacionItems as $item){
            $items[$item['producto_id']] = ['cantidad' => $item['cantidad']];
        }

        $cot_creado = Cotizacion::create([
            'cliente_id' => $this->seleccionado->id
        ]);

        activity('Cotizacion')
            ->performedOn($cot_creado)
            ->log('Creado');

        $cot_creado->productos()->sync($items);

        toast()->success('cotizacion añadida con éxito!')->pushOnNextPage();

        return redirect()->route('proyectos');
    }

    protected $rules = [
        'seleccionado.id' => 'required'
    ];
}
