<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Contacto;
use Usernotnull\Toast\Concerns\WireToast;

class CreateContactos extends Component
{
    use WireToast;

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
            'cli_id' => $this->cli_id,
            'con_nombre' => $this->con_nombre,
            'con_telefono' => $this->con_telefono,
            'con_email' => $this->con_email
        ]);
        $this->modalCreacionContacto = false;
        toast()->success('Contacto añadido con éxito!')->push();
        $this->emit('contactoCreado');
        return redirect()->back();
    }
}
