<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use Livewire\Component;

class CreateCotizaciones extends Component
{
    public $showContinuacion = false;
    public $cot_cliente, $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli;
    public $cotizacionItems = [];
    public $allItems = [];
    public $total;

    public $listeners = ['fillCLiente'];

    public function mount(){
        //$this->allItems =
    }

    public function render()
    {
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


    public function submitCotizacion(){

    }
}
