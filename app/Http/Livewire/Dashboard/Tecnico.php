<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\OrTrabajo;
use Carbon\Carbon;
use Livewire\Component;

class Tecnico extends Component
{
    public $trabajosAsignados, $trabajosIniciados, $trabajosCompletados;



    public function render()
    {
        $this->trabajosAsignados = OrTrabajo::whereHas('tecnicos', function($query){
            return $query->where('tecnico_id','=', auth()->user()->id);
        })->whereMonth('ot_inicio',Carbon::now()->month)->where('ot_estado', 'Planificada')->count();
        $this->trabajosIniciados = OrTrabajo::whereHas('tecnicos', function($query){
            return $query->where('tecnico_id','=', auth()->user()->id);
        })->where('ot_estado', 'Iniciada')->count();
        $this->trabajosCompletados = OrTrabajo::whereHas('tecnicos', function($query){
            return $query->where('tecnico_id','=', auth()->user()->id);
        })->whereMonth('ot_completada',Carbon::now()->month)->where('ot_estado', 'Completada')->count();

        return view('livewire.dashboard.tecnico');
    }
}
