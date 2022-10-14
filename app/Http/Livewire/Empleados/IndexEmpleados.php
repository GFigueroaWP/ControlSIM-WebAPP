<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexEmpleados extends Component
{
    use WithPagination;

    public $filtro;

    public function render()
    {
        $filtro = '%'.$this->filtro .'%';
        return view('livewire.empleados.index-empleados', [
            'empleados' => User::latest()
                        ->orWhere('us_nombre','LIKE',$filtro)
                        ->orWhere('us_username','LIKE',$filtro)
                        ->paginate(10),
        ]);
    }
}
