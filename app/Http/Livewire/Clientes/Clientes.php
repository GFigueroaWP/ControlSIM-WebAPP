<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Cliente;

class Clientes extends Component
{
    use WithPagination;

    public $filtro_cli;

    public function render()
    {
        $filtro_cli = '%'.$this->filtro_cli.'%';

        return view('livewire.clientes.clientes', [
            'clientes' => Cliente::latest()
                        ->orWhere('cli_nombre','LIKE',$filtro_cli)
                        ->paginate(10),
        ]);
    }

}
