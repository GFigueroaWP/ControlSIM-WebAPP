<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\Informe;
use App\Models\OrTrabajo;
use App\Models\Tarea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;
use App\States\Trabajo\Iniciada;
use App\States\Trabajo\Completada;
use App\States\Trabajo\Cancelada;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowTrabajos extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    use WireToast;

    public $informe;

    protected $listeners = ['refreshTrabajo' => '$refresh'];
    public $trabajo;
    public $totalTareas, $tareasCompletadas, $progresoTareas;
    public $show_cot, $show_cliente, $show_direccion;
    public $tarea;

    public function mount(OrTrabajo $trabajo){
        $this->authorize('view', $trabajo);
        $trabajo = $this->trabajo;
        $this->fillDatos();
    }

    public function render()
    {
        $this->totalTareas = $this->trabajo->tareas->count();
        $this->tareasCompletadas = $this->trabajo->tareas->where('tar_estado', true)->count();
        $this->progresoTareas = round(100*($this->tareasCompletadas/$this->totalTareas));

        return view('livewire.trabajos.show-trabajos');
    }

    public function fillDatos(){
        $this->fill([
            'show_cot' => 'COT-'.str_pad($this->trabajo->cotizacion->id,5,'0',STR_PAD_LEFT),
            'show_cliente' => $this->trabajo->cotizacion->cliente->cli_razonsocial,
            'show_direccion' => ''.$this->trabajo->cotizacion->cliente->cli_direccion.' , '.$this->trabajo->cotizacion->cliente->cli_comuna.' , '.$this->trabajo->cotizacion->cliente->cli_ciudad
        ]);
    }

    public function completarTarea(Tarea $tarea){
        $this->tarea = $tarea;
        $this->tarea->tar_estado = true;
        $this->tarea->tar_completada = Carbon::now();

        if($this->trabajo->ot_estado == 'Planificada'){
            $this->trabajo->ot_estado->transitionTo(Iniciada::class);
        }

        $this->tarea->save();

        $this->emit('refreshTrabajo');
    }

    public function subirInforme(){

        $this->validate([
            'informe' => 'mimes:pdf|max:2048', // 2MB Max
        ]);

        $informeCreado = Informe::create([
            'trabajo_id' => $this->trabajo->id
        ]);

        $informeCreado->inf_directorio = 'INF-'.$informeCreado->id.'.OT-'.str_pad($this->trabajo->id,5,'0',STR_PAD_LEFT).'.pdf';

        $informeCreado->save();

        $this->informe->storeAs('informes','INF-'.$informeCreado->id.'.OT-'.str_pad($this->trabajo->id,5,'0',STR_PAD_LEFT).'.pdf','s3');

        toast()->success('Informe añadido añadido con éxito!')->push();

        activity('informes')
            ->performedOn($informeCreado)
            ->log('Informe añadido Creado');

        $this->emit('refreshTrabajo');

        return redirect()->back();
    }

    public function descargarInforme(Informe $descargar){
        return Storage::disk('s3')->download('informes/'.$descargar->inf_directorio);
    }

    public function cancelarTrabajo(){
        $this->trabajo->ot_estado->transitionTo(Cancelada::class);
    }
    public function cerrarTrabajo(){
        $this->trabajo->ot_estado->transitionTo(Completada::class);
    }
}
