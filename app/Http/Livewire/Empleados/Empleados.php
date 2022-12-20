<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\User;
use App\States\User\Deshabilitado;
use Spatie\Permission\Models\Role;

class Empleados extends Component
{
    use WithPagination;

    public $filtro_us;
    public $modalDeshabilitacionEmpleado = false;

    public function render()
    {
        $filtro_us = '%'.$this->filtro_us .'%';

        return view('livewire.empleados.empleados', [
            'empleados' => User::latest()
                        ->orWhere('us_nombre','LIKE',$filtro_us)
                        ->orWhere('us_apellido','LIKE',$filtro_us)
                        ->orWhere('us_username','LIKE',$filtro_us)
                        ->paginate(10),
            'roles' => Role::all()->pluck('name')
        ]);
    }

    public function confirmEmpleadoDeshabilitacion ($id){
        $this->modalDeshabilitacionEmpleado = $id;
    }

    public function cancelDeshabilitar (){
        $this->modalDeshabilitacionEmpleado = false;
    }

    public function deshabilitarEmpleado (User $empleado){
        $empleado->us_estado->transitionTo(Deshabilitado::class);
        $this->modalDeshabilitacionEmpleado = false;
    }
}
