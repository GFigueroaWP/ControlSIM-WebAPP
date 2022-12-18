<?php

namespace App\Http\Livewire\Cotizaciones;

use Livewire\Component;

class Cotizaciones extends Component
{
    public $filtro_cot;

    public function render()
    {
        return view('livewire.cotizaciones.cotizaciones');
    }
}
