<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\OrTrabajo;
use Livewire\Component;

class TrabajosPropios extends Component
{
    public $trabajosAsignados;

    public function mount(){
        $trabajosAsignados = OrTrabajo::whereHas('tecnicos', function($query){
            return $query->where('tecnico_id','=', auth()->user()->id);
        })->get();
    }

    public function render()
    {
        return view('livewire.trabajos.trabajos-propios',[
            'trabajos' => OrTrabajo::whereHas('tecnicos', function($query){
                                            return $query->where('tecnico_id','=', auth()->user()->id);
                                    })->latest()->paginate(10)
        ]);
    }
}
