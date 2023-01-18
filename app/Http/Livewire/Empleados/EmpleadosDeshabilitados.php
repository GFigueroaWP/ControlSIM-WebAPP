<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;
use Usernotnull\Toast\Concerns\WireToast;

class EmpleadosDeshabilitados extends Component
{
    use AuthorizesRequests;
    use WireToast;
    use WithPagination;

    public $filtro_us;
    public $modalHabilitacionEmpleado = false;

    public $listeners = ['empleadoHabilitado' => '$refresh'];

    public function mount(){
        $this->authorize('viewAny', User::class);
    }

    public function render()
    {

        return view('livewire.empleados.empleados-deshabilitados', [
            'empleados' => User::onlyTrashed()
                ->paginate(10),
            'roles' => Role::all()->pluck('name')
        ]);
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

        activity('empleados')
            ->performedOn(User::find($seleccionado))
            ->log('Usuario habilitado');

        $this->modalHabilitacionEmpleado = false;

        toast()->success('Empleado habilitado con éxito!')->push();

        $this->emit('empleadoHabilitado');
    }
}
