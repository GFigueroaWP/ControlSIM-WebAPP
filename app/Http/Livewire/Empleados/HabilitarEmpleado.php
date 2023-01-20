<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use Livewire\Component;

class HabilitarEmpleado extends Component
{
    protected $listeners = ['confirmEmpleadoHabilitacion'];
    public $modalHabilitacionEmpleado = false;

    public function render()
    {
        return view('livewire.empleados.habilitar-empleado');
    }

    public function confirmEmpleadoHabilitacion($id)
    {
        $this->modalHabilitacionEmpleado = $id;
    }

    public function cancelHabilitar()
    {
        $this->modalHabilitacionEmpleado = false;
    }

    public function habilitarEmpleado($seleccionado)
    {

        User::withTrashed()->where('id',$seleccionado)->restore();

        activity('Empleado')
            ->performedOn(User::find($seleccionado))
            ->log('Habilitado');

        $this->modalHabilitacionEmpleado = false;

        toast()->success('Empleado habilitado con éxito!')->push();

        $this->emit('refreshEmpleado');
    }
}
