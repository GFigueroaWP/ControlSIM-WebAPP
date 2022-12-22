<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use Livewire\Component;

class CreateCotizaciones extends Component
{
    public $cot_cliente, $mostrar_id;

    public function render()
    {
        return view('livewire.cotizaciones.create-cotizaciones',[
            'clientes' => Cliente::all()
        ]);
    }

    public function fillcot(){
        $this->fill(['mostrar_id' => $this->cot_cliente]);
    }
}
