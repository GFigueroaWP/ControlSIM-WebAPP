<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Item;
use Livewire\Component;

class CreateCotizaciones extends Component
{
    public $showContinuacion = false;
    public $cot_cliente, $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli;
    public $cotizacionItems = [];
    public $allItems;
    public $total, $subtotal;

    public $listeners = ['fillCLiente'];

    public function mount(){
        $this->allItems = Item::all();
    }

    public function render()
    {
        $total = 0;
        $subtotal = 0;

        return view('livewire.cotizaciones.create-cotizaciones',[
            'clientes' => Cliente::all()
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
        $producto = $this->allItems->find($this->cotizacionItems[$index]['item_id']);
        $this->cotizacionItems[$index]['item_nombre'] = $producto->it_nombre;
        $this->cotizacionItems[$index]['item_precio'] = $producto->it_valor;
        $this->cotizacionItems[$index]['is_saved'] = true;
    }

    public function removeProduct($index){
        unset($this->cotizacionItems[$index]);
        $this->cotizacionItems = array_values($this->cotizacionItems);
    }


    public function submitCotizacion(){
        $this->validate();

        $cotizacion = Cotizacion::create([
            'cli_id' => $this->seleccionado->id
        ]);

        $items = [];

        foreach ($this->cotizacionItems as $item){
            $items[$item['item_id']] = ['cantidad' => $item['cantidad']];
        }

        $this->cotizacion->productos()->sync($items);

        return redirect()->route('cotizaciones');
    }

    protected $rules = [

    ];
}
