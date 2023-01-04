<?php

namespace App\Http\Livewire\Proyectos;

use App\Models\Cotizacion;
use App\Models\Proyecto;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    public $filtro_pr;
    public $modalShowProyecto = false;
    public $proyectoSeleccionado;

    public function render()
    {
        $filtro_pr = '%' . $this->filtro_pr . '%';
        return view('livewire.proyectos.proyectos',[
            'proyectos' => Proyecto::latest()
            ->orWhere('id', 'LIKE', $filtro_pr)
            ->paginate(10)
        ]);
    }

    public function showProgreso(Proyecto $selectProyecto){
        $this->modalShowProyecto = true;
        $this->proyectoSeleccionado = $selectProyecto;
    }
}
