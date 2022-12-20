<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;

class CreateClientes extends Component
{
    public $modalCreacionCliente = false;

    protected $listeners = ['crearCliente'];

    public function render()
    {
        return view('livewire.clientes.create-clientes');
    }

    public function crearCliente(){
        $this->modalCreacionCliente = true;
    }

    public function cancelCrear (){
        $this->modalCreacionCliente = false;
    }

    public $cli_nombre, $cli_razonsocial, $cli_rut, $cli_email, $cli_telefono, $cli_direccion, $cli_comuna, $cli_region;

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

    protected $rules = [
        'cli_nombre' => 'required|alpha_num',
        'cli_razonsocial' => 'required|alpha_num',
        'cli_rut' => 'required|size:10',
        'cli_email' => 'email',
        'cli_telefono' => 'numeric',
        'cli_direccion' => 'alpha_num',
        'cli_comuna' => 'alpha_num',
        'cli_region' => 'alpha_num'
    ];

    protected $messages = [
        'cli_nombre',
        'cli_razonsocial',
        'cli_rut',
        'cli_email',
        'cli_telefono',
        'cli_direccion',
        'cli_comuna',
        'cli_region'
    ];

    public function submitCliente()
    {
        $this->validate();
        Cliente::create([
            'cli_nombre' => $this->cli_nombre,
            'cli_razonsocial' => $this->cli_razonsocial,
            'cli_rut' => $this->cli_rut,
            'cli_email' => $this->cli_email,
            'cli_telefono' => $this->cli_telefono,
            'cli_direccion' => $this->cli_direccion,
            'cli_comuna' => $this->cli_comuna,
            'cli_region' => $this->cli_region
        ]);
        session()->flash('flash.banner', 'Nuevo cliente añadido con éxito');
        session()->flash('flash.bannerStyle', 'success');
        $this->modalCreacionCliente = false;
        return redirect()->to('/clientes');
    }
}
