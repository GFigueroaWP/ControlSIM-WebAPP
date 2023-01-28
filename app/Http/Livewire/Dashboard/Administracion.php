<?php

namespace App\Http\Livewire\Dashboard;

use App\Exports\actividadExport;
use App\Models\Cotizacion;
use App\Models\OrTrabajo;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class Administracion extends Component
{
    public $mes_seleccionado, $year_seleccionado, $inicio, $inicio_date, $mes_count, $select_fecha2, $select_fecha, $comparar_date;
    public $cotizacionesEmitidas, $cotizacionesAceptadas, $cotizacionesRechazadas;
    public $trabajosPlanificados, $trabajosIniciados, $trabajosCancelados, $trabajosCompletados;
    public $actividades;

    public function mount(){
        $this->inicio = Cotizacion::all()->first();
        $this->inicio_date = Carbon::parse($this->inicio->created_at);
        $this->mes_count = $this->inicio_date->diffInMonths(Carbon::now());
    }

    public function render()
    {
        $this->comparar_date = Carbon::parse($this->select_fecha2);
        $this->cotizacionesEmitidas = Cotizacion::whereMonth('created_at',$this->comparar_date->month)->whereYear('created_at',$this->comparar_date->year)->count();
        $this->cotizacionesAceptadas = Cotizacion::whereMonth('updated_at',$this->comparar_date->month)->whereYear('updated_at',$this->comparar_date->year)->where('cot_estado', 'Aceptada')->count();
        $this->cotizacionesRechazadas = Cotizacion::whereMonth('updated_at',$this->comparar_date->month)->whereYear('updated_at',$this->comparar_date->year)->where('cot_estado', 'Rechazada')->count();

        $this->trabajosPlanificados = OrTrabajo::whereMonth('ot_inicio',$this->comparar_date->month)->whereYear('created_at',$this->comparar_date->year)->where('ot_estado', 'Planificada')->count();
        $this->trabajosIniciados = OrTrabajo::whereMonth('updated_at',$this->comparar_date->month)->whereYear('updated_at',$this->comparar_date->year)->where('ot_estado', 'Iniciada')->count();
        $this->trabajosCancelados = OrTrabajo::whereMonth('updated_at',$this->comparar_date->month)->whereYear('updated_at',$this->comparar_date->year)->where('ot_estado', 'Cancelada')->count();
        $this->trabajosCompletados = OrTrabajo::whereMonth('ot_completada',$this->comparar_date->month)->whereYear('ot_completada',$this->comparar_date->year)->where('ot_estado', 'Completada')->count();

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

    public function exportActividad(){
        return Excel::download(new actividadExport, 'Log_de_actividad.xlsx');
    }
}
