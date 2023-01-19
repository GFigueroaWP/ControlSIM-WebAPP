<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\OrTrabajo;
use Carbon\Carbon;
use Livewire\Component;
use App\States\Trabajo\Iniciada;
use App\States\Trabajo\Completada;
use App\States\Trabajo\Cancelada;

class ModalCompletar extends Component
{

    protected $listeners = ['cerrarTrabajo'];
    public $modalCompletarTrabajo = false;
    public $seleccionado, $add_observacion;

    public function render()
    {
        return view('livewire.trabajos.modal-completar');
    }

    public function cerrarTrabajo(OrTrabajo $trabajo){
        $this->seleccionado = $trabajo;
        $this->modalCompletarTrabajo = true;
    }

    public function cancelCompletar(){
        $this->modalCompletarTrabajo = false;
        $this->reset(['add_observacion']);
    }

    public function submitCompletar(){
        $this->seleccionado->ot_observacion = $this->add_observacion;
        $this->seleccionado->save();
        $this->seleccionado->ot_estado->transitionTo(Completada::class);

        $this->seleccionado->ot_completada = Carbon::now();

        $this->seleccionado->save();

        $this->modalCompletarTrabajo = false;
        $this->reset(['add_observacion']);

        activity('Trabajo')
            ->performedOn($this->seleccionado)
            ->log('Completado');

        toast()->success('el trabajo ha sido completado con éxito!')->push();
        $this->emit('refreshTrabajo');
    }
}
