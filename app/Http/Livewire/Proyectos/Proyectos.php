<?php

namespace App\Http\Livewire\Proyectos;

use App\Models\Cotizacion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Proyectos extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $listeners = ['refreshProyecto' => '$refresh'];

    public $filtro_pr;
    public $proyectoSeleccionado;

    public function mount(){
        $this->authorize('viewAny', Cotizacion::class);
    }

    public function render()
    {
        $filtro_pr = '%' . $this->filtro_pr . '%';
        return view('livewire.proyectos.proyectos',[
            'cotizaciones' => Cotizacion::latest()
                            ->orWhere('id','LIKE',$filtro_pr)
                            ->orWhere('created_at','LIKE',$filtro_pr)
                            ->orWhere('updated_at','LIKE',$filtro_pr)
                            ->orWhere('cot_estado','LIKE',$filtro_pr)
                            ->orWhere('trabajo_id','LIKE',$filtro_pr)
                            ->paginate(10)
        ]);
    }

}
