<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Cliente;

class Clientes extends Component
{
    use WithPagination;

    public $filtro_cli;

    public $modalCreacionCliente = false;
    public $edit, $selected_id;

    public function render()
    {
        $filtro_cli = '%'.$this->filtro_cli.'%';

        return view('livewire.clientes.clientes', [
            'clientes' => Cliente::latest()
                        ->orWhere('cli_nombre','LIKE',$filtro_cli)
                        ->paginate(10),
        ]);
    }

    public function cancelCrear (){
        $this->modalCreacionCliente = false;
    }

    public function formatRut()
    {
        $cli_rut = $this-> cli_rut;
        $cli_rut = preg_replace('/[^0-9]+/', '', $cli_rut);
        $cli_rut = substr($cli_rut, 0, 9);
        $length = strlen($cli_rut);
        $formatted = "";
        for ($i = 0; $i < $length; $i++) {
            $formatted .= $cli_rut[$i];
            if($length == 8 && $i == 6){
                $formatted .= "-";
            }
            if($length == 9 && $i == 7){
                $formatted .= "-";
            }
        }
        $this->cli_rut = $formatted;
    }


}
