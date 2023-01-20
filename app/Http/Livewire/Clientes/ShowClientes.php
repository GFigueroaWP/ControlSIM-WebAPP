<?php

namespace App\Http\Livewire\Clientes;

use App\Models\Cliente;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ShowClientes extends Component
{
    use AuthorizesRequests;
    use WireToast;

    public $cliente,
        $cli_razonsocial,
        $cli_giro,
        $cli_rut,
        $cli_email,
        $cli_telefono,
        $cli_direccion,
        $cli_comuna,
        $cli_ciudad;

    protected $listeners = ['contactoCreado' => '$refresh'];

    public function mount(Cliente $cliente)
    {
        $this->fillCliente();
        $this->authorize('viewAny', Cliente::class);
    }

    public function render()
    {
        return view('livewire.clientes.show-clientes', [
            'contactos' => Cliente::find($this->cliente->id)->contactos()->where('cli_id', $this->cliente->id)->get()
        ]);
    }

    public function fillCliente()
    {
        $this->fill([
            'cli_razonsocial' => $this->cliente->cli_razonsocial,
            'cli_giro' => $this->cliente->cli_giro,
            'cli_rut' => $this->cliente->cli_rut,
            'cli_email' => $this->cliente->cli_email,
            'cli_telefono' => $this->cliente->cli_telefono,
            'cli_direccion' => $this->cliente->cli_direccion,
            'cli_comuna' => $this->cliente->cli_comuna,
            'cli_ciudad' => $this->cliente->cli_ciudad
        ]);
    }

    public function updateCliente()
    {

        $this->validate();

        $this->cliente->cli_razonsocial = $this->cli_razonsocial;
        $this->cliente->cli_giro = $this->cli_giro;
        $this->cliente->cli_rut = $this->cli_rut;
        $this->cliente->cli_email = $this->cli_email;
        $this->cliente->cli_telefono = $this->cli_telefono;
        $this->cliente->cli_direccion = $this->cli_direccion;
        $this->cliente->cli_comuna = $this->cli_comuna;
        $this->cliente->cli_ciudad = $this->cli_ciudad;

        $this->cliente->save();

        activity('Cliente')
            ->performedOn($this->cliente)
            ->log('Actualizado');

        toast()->info('Cliente actualizado con éxito!')->push();

        return redirect()->back();
    }

    protected function rules()
    {
        return [
            'cli_razonsocial' => 'required|string',
            'cli_giro' => 'required|string',
            'cli_email' => 'required|email',
            'cli_telefono' => 'required|numeric',
            'cli_direccion' => 'string',
            'cli_comuna' => 'string',
            'cli_ciudad' => 'string'
        ];
    }

    protected $messages = [
        'cli_razonsocial.required' => 'El campo de Razón social es obligatorio',
        'cli_razonsocial.string' => 'El campo de Razón social debe ser en formato alfanumérico',
        'cli_giro.required' => 'El campo de Giro es obligatorio',
        'cli_giro.string' => 'El campo de Giro debe ser en formato alfanumérico',
        'cli_email.required' => 'El campo de Email es obligatorio',
        'cli_email.email' => 'El campo de Email debe estar en formato email@email.xx',
        'cli_telefono.required' => 'El campo de Teléfono es obligatorio',
        'cli_telefono.numeric' => 'El campo de Teléfono solo debe contener números',
        'cli_direccion.string' => 'El campo Dirección debe ser en formato alfanumérico',
        'cli_comuna.string' => 'El campo Comuna debe ser en formato alfanumérico',
        'cli_ciudad.string' => 'El campo Ciudad debe ser en formato alfanumérico'
    ];
}
