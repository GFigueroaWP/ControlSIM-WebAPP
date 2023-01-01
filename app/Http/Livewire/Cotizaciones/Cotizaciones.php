<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class Cotizaciones extends Component
{
    use WithPagination;

    public $filtro_cot;

    public function render()
    {
        $filtro_cot = '%'.$this->filtro_cot .'%';

        return view('livewire.cotizaciones.cotizaciones',[
            'cotizaciones' => Cotizacion::all()
        ]);
    }
}
