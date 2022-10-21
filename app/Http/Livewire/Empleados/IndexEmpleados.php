<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use App\States\User\Deshabilitado;
use Livewire\Component;
use Livewire\WithPagination;

class IndexEmpleados extends Component
{
    use WithPagination;

    public $filtro;
    public $modalDeshabilitacion = false;
    public $modalMostrar = false;

    public function render()
    {
        $filtro = '%'.$this->filtro .'%';
        return view('livewire.empleados.index-empleados', [
            'empleados' => User::where('us_estado','activo')
                        ->orWhere('us_nombre','LIKE',$filtro)
                        ->orWhere('us_username','LIKE',$filtro)
                        ->paginate(10),
        ]);
    }

    public function confirmEmpleadoDeshabilitacion ($id){
        //$empleado->us_estado->transitionTo(Deshabilitado::class);
        $this->modalDeshabilitacion = $id;
    }

    public function deshabilitarEmpleado (User $empleado){
        $empleado->us_estado->transitionTo(Deshabilitado::class);
        $this->modalDeshabilitacion = false;
    }
}
