<?php

namespace App\Http\Livewire\Proyectos;

use App\Models\Proyecto;
use Livewire\Component;

class ModalProgreso extends Component
{
    public $modalShowProyecto = false;
    protected $listeners = ['showProgreso'];
    public $proyectoSeleccionado;
    public $progresoCotizacion = '';
    public $progresoTrabajo = '';
    public $cotizacion_id = '';

    public function render()
    {
        return view('livewire.proyectos.modal-progreso');
    }

    public function showProgreso(Proyecto $selectProyecto){
        $this->modalShowProyecto = true;
        $this->proyectoSeleccionado = $selectProyecto;

        $this->cotizacion_id = $this->proyectoSeleccionado->cotizacion->id;

        if($this->proyectoSeleccionado->cotizacion->cot_estado == 'Emitida'){
            $this->progresoCotizacion = 'Emitida';
        }else if($this->proyectoSeleccionado->cotizacion->cot_estado == 'Rechazada'){
            $this->progresoCotizacion = 'Rechazada';
        }else if($this->proyectoSeleccionado->cotizacion->cot_estado == 'Aceptada'){
            $this->progresoCotizacion = 'Aceptada';
        }

        if($this->proyectoSeleccionado->trabajo->ot_trabajo ?? '' == 'Planificada'){
            $this->progresoTrabajo = 'Planificada';
        }else if($this->proyectoSeleccionado->trabajo->ot_trabajo ?? '' == 'Iniciada'){
            $this->progresoTrabajo = 'Iniciada';
        }else if($this->proyectoSeleccionado->trabajo->ot_trabajo ?? '' == 'Cancelada'){
            $this->progresoTrabajo = 'Cancelada';
        }else if($this->proyectoSeleccionado->trabajo->ot_trabajo ?? '' == 'Completada'){
            $this->progresoTrabajo = 'Completada';
        }
    }
}
