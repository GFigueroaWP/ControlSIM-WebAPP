<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cliente;
use App\Models\Cotizacion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;


class Cotizaciones extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $listeners = ['estadoCotizacionActualizado' => '$refresh'];

    public $filtro_cot;

    public function mount(){
        $this->authorize('viewAny', Cotizacion::class);
    }

    public function render()
    {
        $filtro_cot = '%'.$this->filtro_cot .'%';

        return view('livewire.cotizaciones.cotizaciones',[
            'cotizaciones' => Cotizacion::latest()
                            ->orWhere('id','LIKE',$filtro_cot)
                            ->orWhere('created_at','LIKE',$filtro_cot)
                            ->orWhere('updated_at','LIKE',$filtro_cot)
                            ->orWhere('cot_estado','LIKE',$filtro_cot)
                            ->paginate(10)
        ]);
    }
}
