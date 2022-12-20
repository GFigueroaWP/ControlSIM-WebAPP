<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use App\Models\Contacto;
use Livewire\Component;

class ShowClientes extends Component
{
    public $cliente;

    public function mount(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function render()
    {
        return view('livewire.clientes.show-clientes',[
            'contactos' => Cliente::find($this->cliente->id)->contactos()->where('cli_id', $this->cliente->id)->get()
        ]);
    }

}
