<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Contacto;

class CreateContactos extends Component
{
    public $modalCreacionContacto = false;

    public $con_nombre, $con_email, $con_telefono, $cli_id;

    protected $listeners = ['crearContacto'];

    public function render()
    {
        return view('livewire.clientes.create-contactos');
    }

    public function crearContacto(){
        $this->modalCreacionContacto = true;
    }

    public function cancelCrearContacto (){
        $this->modalCreacionContacto = false;
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
