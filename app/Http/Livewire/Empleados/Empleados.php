<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;
use Usernotnull\Toast\Concerns\WireToast;

class Empleados extends Component
{
    use AuthorizesRequests;
    use WireToast;
    use WithPagination;

    public $filtro_us;
    public $modalDeshabilitacionEmpleado = false;

    public $listeners = ['empleadoCreado' => '$refresh', 'empleadoDeshabilitado' => '$refresh'];

    public function mount(){
        $this->authorize('viewAny', User::class);
    }

    public function render()
    {
        $filtro_us = '%' . $this->filtro_us . '%';

        return view('livewire.empleados.empleados', [
            'empleados' => User::latest()
                ->orWhere('us_email', 'LIKE', $filtro_us)
                ->orWhere('us_rut', 'LIKE', $filtro_us)
                ->orWhere('us_nombre', 'LIKE', $filtro_us)
                ->orWhere('us_apellido', 'LIKE', $filtro_us)
                ->orWhere('us_username', 'LIKE', $filtro_us)
                ->paginate(10),
            'roles' => Role::all()->pluck('name')
        ]);
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

        $this->emit('empleadoDeshabilitado');

        $this->modalDeshabilitacionEmpleado = false;
    }
}
