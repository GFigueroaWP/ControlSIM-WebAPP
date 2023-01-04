<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cotizacion;
use App\States\Cotizacion\Aceptada;
use App\States\Cotizacion\Rechazada;
use Livewire\Component;

class ModalEstados extends Component
{

    protected $listeners = ['editarEstadoCotizacion'];
    public $modalEstadoCotizacion = false;
    public $cotizacion;

    public function render()
    {
        return view('livewire.cotizaciones.modal-estados');
    }

    public function editarEstadoCotizacion(Cotizacion $cotizacionSeleccionada){
        $this->cotizacion = $cotizacionSeleccionada;
        $this->modalEstadoCotizacion = true;
    }

    public function cancelEstado(){
        $this->modalEstadoCotizacion = false;
    }

    public function rechazarEstado(){
        $this->cotizacion->cot_estado->transitionTo(Rechazada::class);
        $this->modalEstadoCotizacion = false;
        return redirect()->route('cotizaciones');
    }

    public function aceptarEstado(){
        $this->cotizacion->cot_estado->transitionTo(Aceptada::class);
        $this->modalEstadoCotizacion = false;
        return redirect()->route('cotizaciones');

    }
}
