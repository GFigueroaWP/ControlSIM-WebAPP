<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cotizacion;
use App\Models\OrTrabajo;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Administracion extends Component
{

    public $cotizacionesEmitidas, $cotizacionesAceptadas, $cotizacionesRechazadas;
    public $trabajosPlanificados, $trabajosIniciados, $trabajosCancelados, $trabajosCompletados;
    public $actividades;

    public function render()
    {
        $this->cotizacionesEmitidas = Cotizacion::whereMonth('created_at',Carbon::now()->month)->count();
        $this->cotizacionesAceptadas = Cotizacion::whereMonth('updated_at',Carbon::now()->month)->where('cot_estado', 'Aceptada')->count();
        $this->cotizacionesRechazadas = Cotizacion::whereMonth('updated_at',Carbon::now()->month)->where('cot_estado', 'Rechazada')->count();

        $this->trabajosPlanificados = OrTrabajo::whereMonth('ot_inicio',Carbon::now()->month)->where('ot_estado', 'Planificada')->count();
        $this->trabajosIniciados = OrTrabajo::whereMonth('updated_at',Carbon::now()->month)->where('ot_estado', 'Iniciada')->count();
        $this->trabajosCancelados = OrTrabajo::whereMonth('updated_at',Carbon::now()->month)->where('ot_estado', 'Cancelada')->count();
        $this->trabajosCompletados = OrTrabajo::whereMonth('ot_completada',Carbon::now()->month)->where('ot_estado', 'Completada')->count();

        $this->actividades = Activity::latest()->take(5)->get();


        return view('livewire.dashboard.administracion');
    }
}
