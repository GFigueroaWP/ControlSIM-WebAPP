<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;

use Livewire\WithPagination;

use App\Models\User;

class View extends Component
{
    use WithPagination;

    public $filtro;

    public function render()
    {
        $filtro = '%'.$this->filtro .'%';
        return view('livewire.empleados.view',[
            'empleados' => User::latest()
                        ->orWhere('us_nombre','LIKE',$filtro)
                        ->orWhere('us_username','LIKE',$filtro)
                        ->paginate(10),
        ]);
    }
}
