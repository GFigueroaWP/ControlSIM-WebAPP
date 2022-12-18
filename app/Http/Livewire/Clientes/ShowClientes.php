<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use App\Models\Contacto;
use Livewire\Component;

class ShowClientes extends Component
{
    public $cliente;

    public $modalCreacionContacto = false;

    public $con_nombre, $con_email, $con_telefono, $cli_id;

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

    protected $rules = [
        'con_nombre' => 'required',
        'con_email' => 'required|email',
        'con_telefono' => 'required|numeric'
    ];

    protected $messages = [
        'con_nombre',
        'con_email',
        'con_telefono'
    ];

    public function submitContacto()
    {
        $this->validate();
        Contacto::create([
            'cli_id' => $this->cliente->id,
            'con_nombre' => $this->con_nombre,
            'con_telefono' => $this->con_telefono,
            'con_email' => $this->con_email
        ]);
        session()->flash('flash.banner', 'Nuevo contacto añadido con éxito');
        session()->flash('flash.bannerStyle', 'success');
        $this->modalCreacionContacto = false;
        return redirect()->route('showClientes',[$this->cliente->id]);
    }
}
