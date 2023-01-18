<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ShowEmpleados extends Component
{
    use AuthorizesRequests;
    use WireToast;

    public $empleado;

    public $us_username, $us_nombre, $us_apellido, $us_rut,
        $us_telefono, $us_email;

    public function mount(User $empleado)
    {
        $this->authorize('viewAny', User::class);
        $this->fillEmpleado();
    }

    public function render()
    {
        return view('livewire.empleados.show-empleados');
    }

    public function fillEmpleado()
    {
        $this->fill([
            'us_username' => $this->empleado->us_username,
            'us_nombre' => $this->empleado->us_nombre,
            'us_apellido' => $this->empleado->us_apellido,
            'us_rut' => $this->empleado->us_rut,
            'us_telefono' => $this->empleado->us_telefono,
            'us_email' => $this->empleado->us_email
        ]);
    }

    public function updateEmpleado()
    {
        $this->validate();

        $this->empleado->us_username = $this->us_username;
        $this->empleado->us_nombre = $this->us_nombre;
        $this->empleado->us_apellido = $this->us_apellido;
        $this->empleado->us_rut = $this->us_rut;
        $this->empleado->us_telefono = $this->us_telefono;
        $this->empleado->us_email = $this->us_email;

        $this->empleado->save();

        activity('empleados')
            ->performedOn($this->empleado)
            ->log('Usuario actualizado');

        toast()->info('Empleado actualizado con éxito!')->push();

        return redirect()->back();
    }

    protected function rules()
    {
        return [
            'us_nombre' => 'required|string',
            'us_apellido' => 'required|string',
            'us_telefono' => 'required|numeric',
            'us_email' => 'required|email'
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
        'us_email.email' => 'El campo de Email debe tener formato email@email.xx'
    ];
}
