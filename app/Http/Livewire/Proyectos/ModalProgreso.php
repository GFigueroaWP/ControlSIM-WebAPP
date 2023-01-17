<?php

namespace App\Http\Livewire\Proyectos;

use App\Models\Cotizacion;
use App\Models\OrTrabajo;
use Livewire\Component;

class ModalProgreso extends Component
{
    public $modalShowProyecto = false;
    protected $listeners = ['showProgreso', 'refreshProyecto' => '$refresh'];
    public $proyectoSeleccionado;
    public $trabajoSeleccionado;
    public $progresoCotizacion = '';
    public $progresoTrabajo = '';
    public $cotizacion_id = '';

    public function render()
    {
        return view('livewire.proyectos.modal-progreso');
    }

    public function showProgreso(Cotizacion $selectCotizacion , OrTrabajo $selectTrabajo){
        $this->modalShowProyecto = true;
        $this->proyectoSeleccionado = $selectCotizacion;
        $this->trabajoSeleccionado = $selectTrabajo;
        $this->progresoTrabajo = 'no';

        $this->cotizacion_id = $this->proyectoSeleccionado->id;

        if($this->proyectoSeleccionado->cot_estado == 'Emitida'){
            $this->progresoCotizacion = 'Emitida';
        }else if($this->proyectoSeleccionado->cot_estado == 'Rechazada'){
            $this->progresoCotizacion = 'Rechazada';
        }else if($this->proyectoSeleccionado->cot_estado == 'Aceptada'){
            $this->progresoCotizacion = 'Aceptada';
        }

        if($this->trabajoSeleccionado->id){
            if($this->trabajoSeleccionado->ot_estado == 'Planificada'){
                $this->progresoTrabajo = 'Planificada';
            }else if($this->trabajoSeleccionado->ot_estado == 'Iniciada'){
                $this->progresoTrabajo = 'Iniciada';
            }else if($this->trabajoSeleccionado->ot_estado == 'Cancelada'){
                $this->progresoTrabajo = 'Cancelada';
            }else if($this->trabajoSeleccionado->ot_estado == 'Completada'){
                $this->progresoTrabajo = 'Completada';
            }
        }
    }
}
