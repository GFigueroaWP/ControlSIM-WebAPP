<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cotizacion;
use App\Models\OrTrabajo;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
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

        $columnChartModel = LivewireCharts::columnChartModel()
                            ->setTitle('Cotizaciones')
                            ->addColumn('emitidas',$this->cotizacionesEmitidas,'#cbd5e0')
                            ->addColumn('aceptadas',$this->cotizacionesAceptadas,'#66DA26')
                            ->addColumn('rechazadas',$this->cotizacionesRechazadas,'#fc8181')->withGrid();

        $columnChartModel2 = LivewireCharts::columnChartModel()
                            ->setTitle('Trabajos')
                            ->addColumn('planificados',$this->trabajosPlanificados,'#cbd5e0')
                            ->addColumn('iniciados',$this->trabajosIniciados,'#f6ad55')
                            ->addColumn('completados',$this->trabajosCompletados,'#66DA26')
                            ->addColumn('cancelados',$this->trabajosCancelados,'#fc8181')->withGrid();

        return view('livewire.dashboard.administracion')->with(['columnChartModel' => $columnChartModel,
                                                                'columnChartModel2' => $columnChartModel2]);
    }
}
