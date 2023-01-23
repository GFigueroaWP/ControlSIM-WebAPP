<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\Informe;
use App\Models\OrTrabajo;
use App\Models\Tarea;
use App\Models\User;
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
    public $show_cot, $show_cliente, $show_direccion, $show_estado, $show_observacion, $show_inicio, $show_limite;
    public $add_tarea;
    public $tarea;
    public $modalCancelarTrabajo = false;
    public $modalCompletarTrabajo = false;
    public $add_observacion;
    public $tecnicos,$añadirTecnico,$tecnico_id2;

    public function mount(OrTrabajo $trabajo){
        $this->authorize('view', $trabajo);
        $trabajo = $this->trabajo;
        $this->fillDatos();
        $this->tecnicos = User::role('Técnico')->get();
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
            'show_direccion' => ''.$this->trabajo->cotizacion->cliente->cli_direccion.' , '.$this->trabajo->cotizacion->cliente->cli_comuna.' , '.$this->trabajo->cotizacion->cliente->cli_ciudad,
            'show_estado' => $this->trabajo->ot_estado.'',
            'show_observacion' => $this->trabajo->ot_observacion.'',
            'show_inicio' => Carbon::parse($this->trabajo->ot_inicio)->format('d-m-Y'),
            'show_limite' => Carbon::parse($this->trabajo->ot_limite)->format('d-m-Y')
        ]);
    }

    public function addTarea(){
        $this->validate([
            'add_tarea' => 'required|string',
        ]);
        Tarea::create([
                'trabajo_id' => $this->trabajo->id,
                'tar_descripcion' => $this->add_tarea
            ]);

        toast()->success('Tarea añadida')->push();

        $this->emit('refreshTrabajo');
    }

    public function addTecnico(){
        if($this->trabajo->tecnicos->contains($this->tecnico_id2)){
            $this->addError('añadirTecnico', 'Esta técnico ya esta asignado al trabajo');
                return;
        }else{
            $this->resetErrorBag();
            $this->trabajo->tecnicos()->attach($this->tecnico_id2);
        activity('Técnico')
            ->performedOn($this->trabajo)
            ->log('Añadido');

        toast()->success('Técnico añadido al trabajo')->push();

        $this->emit('refreshTrabajo');
        }
    }

    public function removeTecnico($id_remove){

        $this->trabajo->tecnicos()->detach($id_remove);

        activity('Técnico')
            ->performedOn($this->trabajo)
            ->log('Removido');

        toast()->info('Técnico removido del trabajo')->push();

        $this->emit('refreshTrabajo');
    }

    public function completarTarea(Tarea $tarea){
        $this->tarea = $tarea;
        $this->tarea->tar_estado = true;
        $this->tarea->tar_completada = Carbon::now();

        if($this->trabajo->ot_estado == 'Planificada'){
            $this->trabajo->ot_estado->transitionTo(Iniciada::class);
        }

        $this->tarea->save();

        activity('Tarea')
            ->performedOn($this->trabajo)
            ->log('Completado');

            toast()->info('Tarea completada')->push();

        $this->emit('refreshTrabajo');
    }

    public function subirInforme(){

        $this->validate([
            'informe' => 'mimes:pdf|max:2048', // 2MB Max
        ]);

        $informeCreado = Informe::create([
            'trabajo_id' => $this->trabajo->id
        ]);

        $informeCreado->inf_directorio = auth()->user()->us_username.'.INF-'.$informeCreado->id.'.OT-'.str_pad($this->trabajo->id,5,'0',STR_PAD_LEFT).'.pdf';

        $informeCreado->save();

        $this->informe->storeAs('informes', auth()->user()->us_username.'.INF-'.$informeCreado->id.'.OT-'.str_pad($this->trabajo->id,5,'0',STR_PAD_LEFT).'.pdf','s3');

        toast()->success('Informe añadido añadido con éxito!')->push();

        activity('Informe')
            ->performedOn($this->trabajo)
            ->log('Añadido');

        $this->emit('refreshTrabajo');

        return redirect()->back();
    }

    public function descargarInforme(Informe $descargar){
        return Storage::disk('s3')->download('informes/'.$descargar->inf_directorio);
    }

    protected $messages = [
        'add_tarea.required' => 'Debe escribir una tarea',
        'add_tarea.string' => 'Debe ser alfanumerico',
        'mimes' => 'El archivo debe ser pdf',
        'max' => 'El archivo no debe pesar mas de 2MB'
    ];
}
