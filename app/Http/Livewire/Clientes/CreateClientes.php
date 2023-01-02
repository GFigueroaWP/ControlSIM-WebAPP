<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use App\Rules\rutValido;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateClientes extends Component
{
    use WireToast;

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
        $this->reset(['cli_nombre', 'cli_razonsocial', 'cli_giro', 'cli_rut', 'cli_email', 'cli_telefono', 'cli_direccion', 'cli_comuna', 'cli_ciudad']);
    }

    public $cli_nombre, $cli_razonsocial, $cli_giro, $cli_rut, $cli_email, $cli_telefono, $cli_direccion, $cli_comuna, $cli_ciudad;

    public function formatRut()
    {
        $cli_rut = $this->cli_rut;
        $length = strlen($cli_rut);
        $cli_rut = strtoupper($cli_rut);
        if($length == 8 || $length == 9){
            $formateado = substr_replace($cli_rut, '.', -7, 0);
            $formateado = substr_replace($formateado, '.', -4, 0);
            $formateado = substr_replace($formateado, '-', -1, 0);
        }
        else{
            return;
        }
        $this->cli_rut = $formateado;
    }

    protected $rules = [
        'cli_nombre' => 'required|alpha_num',
        'cli_razonsocial' => 'required|alpha_num',
        'cli_giro' => 'required',
        'cli_rut' => 'required|size:10',
        'cli_email' => 'email',
        'cli_telefono' => 'numeric',
        'cli_direccion' => 'alpha_num',
        'cli_comuna' => 'alpha_num',
        'cli_ciudad' => 'alpha_num'
    ];

    protected function rules(){
        return [
            'cli_nombre' => 'required|alpha_num',
            'cli_razonsocial' => 'required|alpha_num',
            'cli_giro' => 'required',
            'cli_rut' => ['required',new rutValido],
            'cli_email' => 'email',
            'cli_telefono' => 'numeric',
            'cli_direccion' => 'alpha_num',
            'cli_comuna' => 'alpha_num',
            'cli_ciudad' => 'alpha_num'
        ];
    }

    protected $messages = [
        'cli_nombre',
        'cli_razonsocial',
        'cli_giro',
        'cli_rut',
        'cli_email',
        'cli_telefono',
        'cli_direccion',
        'cli_comuna',
        'cli_ciudad'
    ];

    public function submitCliente()
    {
        $this->validate();
        Cliente::create([
            'cli_nombre' => $this->cli_nombre,
            'cli_razonsocial' => $this->cli_razonsocial,
            'cli_giro' => $this->cli_giro,
            'cli_rut' => $this->cli_rut,
            'cli_email' => $this->cli_email,
            'cli_telefono' => $this->cli_telefono,
            'cli_direccion' => $this->cli_direccion,
            'cli_comuna' => $this->cli_comuna,
            'cli_ciudad' => $this->cli_ciudad
        ]);
        $this->modalCreacionCliente = false;
        $this->reset(['cli_nombre', 'cli_razonsocial', 'cli_giro', 'cli_rut', 'cli_email', 'cli_telefono', 'cli_direccion', 'cli_comuna', 'cli_ciudad']);
        toast()->success('Cliente añadido con éxito!')->push();
        $this->emit('clienteCreado');
        return redirect()->back();
    }
}
