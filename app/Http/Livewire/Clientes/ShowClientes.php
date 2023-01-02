<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ShowClientes extends Component
{
    use WireToast;

    public $cliente,
    $show_cli_nombre,
    $show_cli_razonsocial,
    $show_cli_giro,
    $show_cli_rut,
    $show_cli_email,
    $show_cli_telefono,
    $show_cli_direccion,
    $show_cli_comuna,
    $show_cli_ciudad;

    public $listeners = ['contactoCreado' => '$refresh'];

    public function mount(Cliente $cliente)
    {
        $this->fillCliente();
    }

    public function render()
    {
        return view('livewire.clientes.show-clientes',[
            'contactos' => Cliente::find($this->cliente->id)->contactos()->where('cli_id', $this->cliente->id)->get()
        ]);
    }

    public function fillCliente(){
        $this->fill([
            'show_cli_nombre' => $this->cliente->cli_nombre,
            'show_cli_razonsocial' => $this->cliente->cli_razonsocial,
            'show_cli_giro' => $this->cliente->cli_giro,
            'show_cli_rut' => $this->cliente->cli_rut,
            'show_cli_email' => $this->cliente->cli_email,
            'show_cli_telefono' => $this->cliente->cli_telefono,
            'show_cli_direccion' => $this->cliente->cli_direccion,
            'show_cli_comuna' => $this->cliente->cli_comuna,
            'show_cli_ciudad' => $this->cliente->cli_ciudad
        ]);
    }

    protected function rules(){
        return [
            'show_cli_nombre' => 'required|alpha_num',
            'show_cli_razonsocial' => 'required|alpha_num',
            'show_cli_giro' => 'required',
            'show_cli_rut' => 'required',
            'show_cli_email' => 'email',
            'show_cli_telefono' => 'numeric',
            'show_cli_direccion' => 'alpha_num',
            'show_cli_comuna' => 'alpha_num',
            'show_cli_ciudad' => 'alpha_num'
        ];
    }

    protected $messages = [
        'show_cli_nombre',
        'show_cli_razonsocial',
        'show_cli_giro',
        'show_cli_rut',
        'show_cli_email',
        'show_cli_telefono',
        'show_cli_direccion',
        'show_cli_comuna',
        'show_cli_ciudad'
    ];

    public function updateCliente(){

        $this->validate();

        $this->cliente->cli_nombre = $this->show_cli_nombre;
        $this->cliente->cli_razonsocial = $this->show_cli_razonsocial;
        $this->cliente->cli_giro = $this->show_cli_giro;
        $this->cliente->cli_rut = $this->show_cli_rut;
        $this->cliente->cli_email = $this->show_cli_email;
        $this->cliente->cli_telefono = $this->show_cli_telefono;
        $this->cliente->cli_direccion = $this->show_cli_direccion;
        $this->cliente->cli_comuna = $this->show_cli_comuna;
        $this->cliente->cli_ciudad = $this->show_cli_ciudad;

        $this->cliente->save();

        toast()->info('Cliente actualizado con éxito!')->push();
        return redirect()->back();
    }
}
