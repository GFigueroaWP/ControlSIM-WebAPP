<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Item;
use App\Models\Proyecto;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateCotizaciones extends Component
{
    use WireToast;

    public $showContinuacion = false;
    public $clientes;
    public $cot_cliente, $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli, $item_id2;
    public $cotizacionItems = [];
    public $allItems;
    public $total, $subtotal, $iva;

    public $listeners = ['fillCLiente'];

    public function mount(){
        $this->allItems = Item::all();
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
        $this->showContinuacion = true;
    }

    public function addProduct(){
        foreach($this->cotizacionItems as $key => $cotizacionItem){
            if(!$cotizacionItem['is_saved']){
                $this->addError('cotizacionItems'.$key, 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }
        }
        $this->cotizacionItems[] = [
            'item_id' => '',
            'cantidad' => 1,
            'is_saved' => false,
            'item_nombre' => '',
            'item_precio' => 0
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
        $this->cotizacionItems[$index]['item_id'] = $this->item_id2;

        $producto = $this->allItems->find($this->cotizacionItems[$index]['item_id']);
        $this->cotizacionItems[$index]['item_nombre'] = $producto->it_nombre;
        $this->cotizacionItems[$index]['item_precio'] = $producto->it_valor;
        $this->cotizacionItems[$index]['is_saved'] = true;

        $this->subtotal += $producto->it_valor * $this->cotizacionItems[$index]['cantidad'];
        $this->iva = $this->subtotal * 0.19;
        $this->total = $this->iva + $this->subtotal;

    }

    public function removeProduct($index){
        $this->subtotal -= $this->cotizacionItems[$index]['item_precio'] * $this->cotizacionItems[$index]['cantidad'];
        $this->iva = $this->subtotal * 0.19;
        $this->total = $this->iva + $this->subtotal;

        unset($this->cotizacionItems[$index]);
        $this->cotizacionItems = array_values($this->cotizacionItems);
    }


    public function submitCotizacion(){
        $this->validate();

        $items = [];

        foreach ($this->cotizacionItems as $item){
            $items[$item['item_id']] = ['cantidad' => $item['cantidad']];
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
