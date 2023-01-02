<?php

namespace App\Http\Livewire\Proyectos;

use App\Models\Proyecto;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    public $filtro_pr;

    public function render()
    {
        $filtro_pr = '%' . $this->filtro_pr . '%';
        return view('livewire.proyectos.proyectos',[
            'proyectos' => Proyecto::latest()
            ->orWhere('id', 'LIKE', $filtro_pr)
            ->paginate(10)
        ]);
    }
}
