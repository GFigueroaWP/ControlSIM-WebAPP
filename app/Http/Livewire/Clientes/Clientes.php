<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Cliente;

class Clientes extends Component
{
    use WithPagination;

    public $filtro_cli;

    public $listeners = ['clienteCreado' => '$refresh'];

    public function render()
    {
        $filtro_cli = '%' . $this->filtro_cli . '%';

        return view('livewire.clientes.clientes', [
            'clientes' => Cliente::latest()
                ->orWhere('cli_razonsocial', 'LIKE', $filtro_cli)
                ->orWhere('cli_giro', 'LIKE', $filtro_cli)
                ->orWhere('cli_rut', 'LIKE', $filtro_cli)
                ->paginate(10),
        ]);
    }
}
