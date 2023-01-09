<?php

namespace App\Http\Livewire\Cotizaciones;

use App\Models\Cotizacion;
use Livewire\Component;
use Livewire\WithPagination;


class Cotizaciones extends Component
{
    use WithPagination;

    protected $listeners = ['estadoCotizacionActualizado' => '$refresh'];

    public $filtro_cot;

    public function render()
    {
        $filtro_cot = '%'.$this->filtro_cot .'%';

        return view('livewire.cotizaciones.cotizaciones',[
            'cotizaciones' => Cotizacion::latest()
                            ->Where('id','LIKE',$filtro_cot)
                            ->paginate(10)
        ]);
    }
}
