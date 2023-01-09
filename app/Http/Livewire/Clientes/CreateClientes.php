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

    public $cli_razonsocial, $cli_giro, $cli_rut, $cli_email, $cli_telefono, $cli_direccion, $cli_comuna, $cli_ciudad;

    protected $listeners = ['crearCliente'];

    public function render()
    {
        return view('livewire.clientes.create-clientes');
    }

    public function crearCliente()
    {
        $this->modalCreacionCliente = true;
    }

    public function cancelCrear()
    {
        $this->modalCreacionCliente = false;
        $this->reset(['cli_razonsocial', 'cli_giro', 'cli_rut', 'cli_email', 'cli_telefono', 'cli_direccion', 'cli_comuna', 'cli_ciudad']);
    }

    public function formatRut()
    {
        $cli_rut = $this->cli_rut;
        $length = strlen($cli_rut);
        $cli_rut = strtoupper($cli_rut);
        if ($length == 8 || $length == 9) {
            $formateado = substr_replace($cli_rut, '.', -7, 0);
            $formateado = substr_replace($formateado, '.', -4, 0);
            $formateado = substr_replace($formateado, '-', -1, 0);
        } else {
            return;
        }
        $this->cli_rut = $formateado;
    }

    public function submitCliente()
    {
        $this->validate();

        $creado = Cliente::create([
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

        $this->reset(['cli_razonsocial', 'cli_giro', 'cli_rut', 'cli_email', 'cli_telefono', 'cli_direccion', 'cli_comuna', 'cli_ciudad']);

        activity('Clientes')
            ->performedOn($creado)
            ->log('Creado');

        toast()->success('Cliente añadido con éxito!')->push();

        $this->emit('clienteCreado');

        return redirect()->back();
    }

    protected function rules()
    {
        return [
            'cli_razonsocial' => 'required|string',
            'cli_giro' => 'required|string',
            'cli_rut' => ['required', new rutValido, 'unique:clientes', 'min:11', 'max:12'],
            'cli_email' => 'required|email|unique:clientes',
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
        'cli_rut.required' => 'El campo de Rut es obligatorio',
        'cli_rut.unique' => 'El Rut ya se encuentra registrado',
        'cli_rut.min' => 'El Rut no cumple con el tamaño',
        'cli_rut.max' => 'El Rut no cumple con el tamaño',
        'cli_email.required' => 'El campo de Email es obligatorio',
        'cli_email.email' => 'El campo de Email debe estar en formato email@email.xx',
        'cli_email.unique' => 'El Email ya se encuentra registrado',
        'cli_telefono.required' => 'El campo de Teléfono es obligatorio',
        'cli_telefono.numeric' => 'El campo de Teléfono solo debe contener números',
        'cli_direccion.string' => 'El campo Dirección debe ser en formato alfanumérico',
        'cli_comuna.string' => 'El campo Comuna debe ser en formato alfanumérico',
        'cli_ciudad.string' => 'El campo Ciudad debe ser en formato alfanumérico'
    ];
}
