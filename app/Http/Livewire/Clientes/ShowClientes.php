<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use App\Models\Contacto;
use Livewire\Component;

class ShowClientes extends Component
{
    public $cliente,$cli_nombre,
    $cli_razonsocial,
    $cli_giro,
    $cli_rut,
    $cli_email,
    $cli_telefono,
    $cli_direccion,
    $cli_comuna,
    $cli_region;

    public $listeners = ['contactoCreado' => '$refresh'];

    public function mount(Cliente $cliente)
    {

    }

    public function render()
    {
        return view('livewire.clientes.show-clientes',[
            'contactos' => Cliente::find($this->cliente->id)->contactos()->where('cli_id', $this->cliente->id)->get(),
            $this->fillCliente()
        ]);
    }

    public function fillCliente(){
        $this->fill([
            'cli_nombre' => $this->cliente->cli_nombre,
            'cli_razonsocial' => $this->cliente->cli_razonsocial,
            'cli_giro' => $this->cliente->cli_giro,
            'cli_rut' => $this->cliente->cli_rut,
            'cli_email' => $this->cliente->cli_email,
            'cli_telefono' => $this->cliente->cli_telefono,
            'cli_direccion' => $this->cliente->cli_direccion,
            'cli_comuna' => $this->cliente->cli_comuna,
            'cli_region' => $this->cliente->cli_region
        ]);
    }
}
