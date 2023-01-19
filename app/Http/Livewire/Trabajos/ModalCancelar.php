<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\OrTrabajo;
use App\States\Cotizacion\Emitida;
use Livewire\Component;
use App\States\Trabajo\Iniciada;
use App\States\Trabajo\Completada;
use App\States\Trabajo\Cancelada;

class ModalCancelar extends Component
{
    protected $listeners = ['cancelarTrabajo'];
    public $seleccionado, $add_observacion;

    public function mount(){

    }

    public $modalCancelarTrabajo = false;

    public function render()
    {
        return view('livewire.trabajos.modal-cancelar');
    }


    public function cancelarTrabajo(OrTrabajo $trabajo){
        $this->seleccionado = $trabajo;
        $this->modalCancelarTrabajo = true;
    }

    public function cancelCancelar(){
        $this->modalCancelarTrabajo = false;
        $this->reset(['add_observacion']);
    }

    public function submitCancelar(){
        $this->seleccionado->ot_observacion = $this->add_observacion;
        $this->seleccionado->save();
        $this->seleccionado->ot_estado->transitionTo(Cancelada::class);

        $this->modalCancelarTrabajo = false;
        $this->reset(['add_observacion']);

        activity('Trabajo')
            ->performedOn($this->seleccionado)
            ->log('Cancelado');

            toast()->success('el trabajo ha sido cancelado con éxito!')->push();

            $this->emit('refreshTrabajo');
    }

}
