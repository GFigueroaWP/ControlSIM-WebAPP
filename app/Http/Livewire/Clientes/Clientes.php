<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Cliente;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Clientes extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $filtro_cli;

    public $listeners = ['clienteCreado' => '$refresh'];

    public function mount(){
        $this->authorize('viewAny', Cliente::class);
    }

    public function render()
    {
        $filtro_cli = '%' . $this->filtro_cli . '%';

        return view('livewire.clientes.clientes', [
            'clientes' => Cliente::latest()
                ->orWhere('cli_razonsocial', 'LIKE', $filtro_cli)
                ->orWhere('cli_giro', 'LIKE', $filtro_cli)
                ->orWhere('cli_rut', 'LIKE', $filtro_cli)
                ->orWhere('cli_direccion', 'LIKE', $filtro_cli)
                ->orWhere('cli_comuna', 'LIKE', $filtro_cli)
                ->orWhere('cli_ciudad', 'LIKE', $filtro_cli)
                ->paginate(10),
        ]);
    }
}
