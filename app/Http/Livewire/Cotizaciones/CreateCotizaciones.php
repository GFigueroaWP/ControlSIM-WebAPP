<?php

namespace App\Http\Livewire\Cotizaciones;

use Livewire\Component;

class CreateCotizaciones extends Component
{
    public $modalCreacionCotizacion = false;

    protected $listeners = ['crearCotizacion'];

    public function render()
    {
        return view('livewire.cotizaciones.create-cotizaciones');
    }

    public function crearCotizacion(){
        $this->modalCreacionCotizacion = true;
    }
}
