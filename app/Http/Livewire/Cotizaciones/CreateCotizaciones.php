<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use Livewire\Component;

class CreateCotizaciones extends Component
{
    public $cot_cliente, $select_id, $prueba_id;

    public $listeners = ['fillCLiente'];

    public function render()
    {
        return view('livewire.cotizaciones.create-cotizaciones',[
            'clientes' => Cliente::all()
        ]);
    }

    public function fillCliente(){
        $this->fill(['prueba_id' => $this->select_id]);
    }

    public function submitCotizacion(){

    }
}
