<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\Cotizacion;
use App\Models\OrTrabajo;
use App\Models\Tarea;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateOrden extends Component
{
    use AuthorizesRequests;
    use WireToast;

    public $cotizacion;
    public $cliente;
    public $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli, $cotizacion_id, $tecnico_id2;
    public $tecnicosSeleccionados = [];
    public $idSeleccionados = [];
    public $tareasAgregadas = [];
    public $tecnicos;
    public $toggleTareas = false;
    public $fechaActual;
    public $fechaInicio, $fechaLimite;

    public function mount(Cotizacion $cotizacion){
        $this->authorize('create', OrTrabajo::class);
        $this->tecnicos = User::role('Técnico')->get();
        $this->cotizacion = $cotizacion;
        $this->fillDatos();
    }
    public function render()
    {
        $this->fechaActual = Carbon::now()->format('Y-m-d');

        foreach($this->tecnicosSeleccionados as $tecnicoSeleccionado){
            $this->idSeleccionados = $tecnicoSeleccionado['tecnico_id'];
        }
        $this->tecnicos = $this->tecnicos->except($this->idSeleccionados);
        return view('livewire.trabajos.create-orden',[
            'tecnicos' => $this->tecnicos,
            'fechaActual' => $this->fechaActual
        ]);
    }

    public function fillDatos(){
        $this->fill(['rut_cli'=> $this->cotizacion->cliente->cli_rut,
        'razon_cli'=> $this->cotizacion->cliente->cli_razonsocial,
        'giro_cli'=> $this->cotizacion->cliente->cli_giro,
        'direccion_cli'=> $this->cotizacion->cliente->cli_direccion,
        'cotizacion_id'=> 'COT-'.str_pad($this->cotizacion->id,5,'0',STR_PAD_LEFT)
    ]);
    }

    public function addTecnico(){

        foreach($this->tecnicosSeleccionados as $index => $tecnicoSeleccionado){
            if(!$tecnicoSeleccionado['is_saved']){
                $this->addError('tecnicosSeleccionados'.$index.'tecnico_id', 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }
        }

        $this->tecnicosSeleccionados[] = [
            'tecnico_id' => '',
            'tecnico_nombre' => '',
            'tecnico_apellido' => '',
            'is_saved' => false,
        ];

        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function generarCotizacion(){
        return redirect()->route('generarCotizacion', $this->cotizacion->id);
    }

    public function editTecnico($index){
        foreach($this->tecnicosSeleccionados as $index => $tecnicoSeleccionado){
            if(!$tecnicoSeleccionado['is_saved']){
                $this->addError('tecnicosSeleccionados'.$index.'tecnico_id', 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }

        }
        $this->tecnicosSeleccionados[$index]['is_saved'] = false;
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function saveTecnico($index){
        $this->resetErrorBag();
        $this->tecnicosSeleccionados[$index]['tecnico_id'] = $this->tecnico_id2;

        $tecnico = $this->tecnicos->find($this->tecnicosSeleccionados[$index]['tecnico_id']);
        $this->tecnicosSeleccionados[$index]['tecnico_nombre'] = $tecnico->us_nombre;
        $this->tecnicosSeleccionados[$index]['tecnico_apellido'] = $tecnico->us_apellido;

        $this->tecnicosSeleccionados[$index]['is_saved'] = true;
        $this->toggleTareas = true;
    }

    public function removeTecnico($index){
        unset($this->tecnicosSeleccionados[$index]);
        $this->tecnicosSeleccionados = array_values($this->tecnicosSeleccionados);
    }

    public function addTarea(){

        foreach($this->tareasAgregadas as $index => $tareaAgregada){
            if(!$tareaAgregada['is_saved']){
                $this->addError('tareasAgregadas'.$index.'tarea', 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }
        }

        $this->tareasAgregadas[] = [
            'tarea' => '',
            'is_saved' => false,
        ];

        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function editTarea($index){
        foreach($this->tareasAgregadas as $index => $tareaAgregada){
            if(!$tareaAgregada['is_saved']){
                $this->addError('tareasAgregadas'.$index.'tarea', 'Esta linea debe ser guardada antes de añadir otro elemento');
                return;
            }

        }
        $this->tareasAgregadas[$index]['is_saved'] = false;
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function saveTarea($index){
        $this->resetErrorBag();
        $this->tareasAgregadas[$index]['is_saved'] = true;
    }

    public function removeTarea($index){
        unset($this->tareasAgregadas[$index]);
        $this->tareasAgregadas = array_values($this->tareasAgregadas);
    }

    public function submitOrden(){
        $this->validate();

        $tecnicos = [];

        foreach($this->tecnicosSeleccionados as $tecnicoSeleccionado){
            $tecnicos[$tecnicoSeleccionado['tecnico_id']] = $tecnicoSeleccionado['tecnico_id'];
        }

        $ot_creada = OrTrabajo::create([
            'cotizacion_id' => $this->cotizacion->id,
            'ot_inicio' => $this->fechaInicio,
            'ot_limite' => $this->fechaLimite,
        ]);

        foreach($this->tareasAgregadas as $tarea){
            Tarea::create([
                'trabajo_id' => $ot_creada['id'],
                'tar_descripcion' => $tarea['tarea']
            ]);
        }

        $ot_creada->tecnicos()->sync($tecnicos);

        toast()->success('orden añadida con éxito!')->pushOnNextPage();
        return redirect()->route('proyectos');
    }

    protected $rules = [
        'fechaInicio' => 'required'
    ];

    protected $messages = [

    ];
}
