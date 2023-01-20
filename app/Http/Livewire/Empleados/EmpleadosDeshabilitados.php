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

    protected $listeners = ['refreshEmpleado' => '$refresh'];

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
}
