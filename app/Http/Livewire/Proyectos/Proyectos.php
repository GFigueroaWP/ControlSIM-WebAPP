<?php

namespace App\Http\Livewire\Proyectos;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use WithPagination;

    protected $listeners = ['refreshProyecto' => '$refresh'];

    public $filtro_pr;
    public $proyectoSeleccionado;

    public function render()
    {
        $filtro_pr = '%' . $this->filtro_pr . '%';
        return view('livewire.proyectos.proyectos',[
            'cotizaciones' => Cotizacion::latest()
            ->orWhere('id', 'LIKE', $filtro_pr)
            ->paginate(10)
        ]);
    }

}
