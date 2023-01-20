<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use Livewire\Component;

class DeshabilitarEmpleado extends Component
{

    protected $listeners = ['confirmEmpleadoDeshabilitacion'];
    public $modalDeshabilitacionEmpleado = false;

    public function render()
    {
        return view('livewire.empleados.deshabilitar-empleado');
    }

    public function confirmEmpleadoDeshabilitacion($id)
    {
        $this->modalDeshabilitacionEmpleado = $id;
    }

    public function cancelDeshabilitar()
    {
        $this->modalDeshabilitacionEmpleado = false;
    }

    public function deshabilitarEmpleado(User $seleccionado)
    {
        $seleccionado->delete();

        activity('Empleado')
            ->performedOn($seleccionado)
            ->log('Deshabilitado');

        toast()->success('Empleado deshabilitado con éxito!')->push();

        $this->emit('refreshEmpleado');

        $this->modalDeshabilitacionEmpleado = false;
    }
}
