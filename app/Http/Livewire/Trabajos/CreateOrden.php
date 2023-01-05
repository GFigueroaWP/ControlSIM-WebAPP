<?php

namespace App\Http\Livewire\Trabajos;

use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\User;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateOrden extends Component
{
    use WireToast;

    public $proyecto;
    public $cliente;
    public $select_id, $seleccionado, $rut_cli, $razon_cli, $giro_cli, $direccion_cli, $tecnico_id2;
    public $tecnicosSeleccionados = [];
    public $tecnicos;
    public $toggleTareas = false;

    public function mount(Proyecto $proyecto){
        $this->tecnicos = User::role('tecnico')->get();
        $this->proyecto = $proyecto;
        $this->fillCliente();
    }
    public function render()
    {
        /* $this->tecnicos = $this->tecnicos->except(); */
        return view('livewire.trabajos.create-orden');
    }

    public function fillCliente(){
        $this->fill(['rut_cli'=> $this->proyecto->cotizacion->cliente->cli_rut,
        'razon_cli'=> $this->proyecto->cotizacion->cliente->cli_razonsocial,
        'giro_cli'=> $this->proyecto->cotizacion->cliente->cli_giro,
        'direccion_cli'=> $this->proyecto->cotizacion->cliente->cli_direccion]);
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

    public function submitOrden(){

    }
}
