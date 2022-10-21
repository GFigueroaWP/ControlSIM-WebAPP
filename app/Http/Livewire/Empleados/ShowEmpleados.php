<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;

class ShowEmpleados extends Component
{
    public $modalMostrar = false;

    public function render()
    {
        return view('livewire.empleados.show-empleados');
    }
}
