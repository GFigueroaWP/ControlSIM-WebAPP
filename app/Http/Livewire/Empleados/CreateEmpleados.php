<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use App\Rules\rutValido;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class CreateEmpleados extends Component
{
    use WireToast;

    public $modalCreacionEmpleado = false;

    public $us_username, $us_nombre, $us_apellido, $us_rut,
        $us_telefono, $us_email, $password, $cargo;

    protected $listeners = ['crearEmpleado'];

    public function render()
    {
        return view('livewire.empleados.create-empleados', [
            'roles' => Role::all()->pluck('name')
        ]);
    }

    public function crearEmpleado()
    {
        $this->modalCreacionEmpleado = true;
    }

    public function cancelCrear()
    {
        $this->modalCreacionEmpleado = false;
        $this->reset([
            'us_username', 'us_nombre', 'us_apellido', 'us_rut',
            'us_telefono', 'us_email', 'password', 'cargo'
        ]);
    }

    public function formatRut()
    {
        $us_rut = $this->us_rut;
        $length = strlen($us_rut);
        $us_rut = strtoupper($us_rut);
        if ($length == 8 || $length == 9) {
            $formateado = substr_replace($us_rut, '.', -7, 0);
            $formateado = substr_replace($formateado, '.', -4, 0);
            $formateado = substr_replace($formateado, '-', -1, 0);
        } else {
            return;
        }
        $this->us_rut = $formateado;
    }

    public function submitEmpleado()
    {
        $this->validate();

        $creado = User::create([
            'us_username' => $this->us_username,
            'us_nombre' => $this->us_nombre,
            'us_apellido' => $this->us_apellido,
            'us_rut' => $this->us_rut,
            'us_telefono' => $this->us_telefono,
            'us_email' => $this->us_email,
            'password' => Hash::make('ControlSIM123')
        ])->assignRole($this->cargo);

        $this->modalCreacionEmpleado = false;

        $this->reset([
            'us_username', 'us_nombre', 'us_apellido', 'us_rut',
            'us_telefono', 'us_email', 'cargo'
        ]);

        toast()->success('Empleado añadido con éxito!')->push();

        activity('empleados')
            ->performedOn($creado)
            ->log('Usuario Creado');

        $this->emit('empleadoCreado');

        return redirect()->back();
    }

    protected function rules()
    {
        return [
            'us_username' => 'required|alpha_dash|unique:users',
            'us_nombre' => 'required|string',
            'us_apellido' => 'required|string',
            'us_rut' => ['required', new rutValido,'unique:users', 'min:11', 'max:12'],
            'us_telefono' => 'required|numeric',
            'us_email' => 'required|email|unique:users',
            'cargo' =>  'required|exists:roles,name'
        ];
    }

    protected $messages = [
        'us_username.required' => 'El campo de Usuario es obligatorio',
        'us_username.alpha_num' => 'El Nombre de usuario debe ser en formato alfanumérico y sin espacios',
        'us_username.unique' => 'El Nombre de usuario especificado ya esta en uso',
        'us_nombre.required' => 'El campo de Nombre es obligatorio',
        'us_nombre.string' => 'El campo de Nombre debe ser en formato alfabético',
        'us_apellido.required' => 'El campo de Apellido es obligatorio',
        'us_apellido.string' => 'El campo de Apellido debe ser en formato alfabético',
        'us_rut.required' => 'El campo de Rut es obligatorio',
        'us_rut.unique' => 'El Rut ya se encuentra registrado',
        'us_rut.min' => 'El Rut no cumple con el tamaño',
        'us_rut.mix' => 'El Rut no cumple con el tamaño',
        'us_telefono.required' => 'El campo de Teléfono es obligatorio',
        'us_telefono.numeric' => 'El campo de Teléfono debe ser solo numérico',
        'us_email.required' => 'El campo de Email es obligatorio',
        'us_email.email' => 'El campo de Email debe tener formato email@email.xx',
        'us_email.unique' => 'La dirección de correo ya esta en uso por otro usuario',
        'cargo.required' => 'El campo de Cargo es obligatorio',
        'cargo.exists' => 'El cargo seleccionado no se encuentra en los registros'
    ];
}
