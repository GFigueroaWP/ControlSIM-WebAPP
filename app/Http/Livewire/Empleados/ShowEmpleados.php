<?php

namespace App\Http\Livewire\Empleados;

use App\Models\User;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class ShowEmpleados extends Component
{
    use WireToast;

    public $empleado;

    public $show_us_username, $show_us_nombre, $show_us_apellido, $show_us_rut,
        $show_us_telefono, $show_us_email;

    public function mount(User $empleado)
    {
        $this->fillEmpleado();
    }

    public function render()
    {
        return view('livewire.empleados.show-empleados');
    }

    public function fillEmpleado()
    {
        $this->fill([
            'show_us_username'=> $this->empleado->us_username,
            'show_us_nombre' => $this->empleado->us_nombre,
            'show_us_apellido' => $this->empleado->us_apellido,
            'show_us_rut' => $this->empleado->us_rut,
            'show_us_telefono' => $this->empleado->us_telefono,
            'show_us_email' => $this->empleado->us_email
        ]);
    }

    public function formatRut()
    {
        $us_rut = $this->us_rut;
        $dv = substr($us_rut, -1);
        $length = strlen($us_rut);
        if($length == 8 || $length == 9){
            $formateado = substr_replace($us_rut, '-', -1, 0);
        }
        /* $us_rut = $this->us_rut;
        $us_rut = preg_replace('/[^0-9]+/', '', $us_rut);
        $us_rut = substr($us_rut, 0, 9);
        $length = strlen($us_rut);
        $formatted = "";
        for ($i = 0; $i < $length; $i++) {
            $formatted .= $us_rut[$i];
            if ($length == 8 && $i == 6) {
                $formatted .= "-";
            }
            if ($length == 9 && $i == 7) {
                $formatted .= "-";
            }
        } */
        $this->us_rut = $formateado;
    }

    protected $rules = [
        'show_us_username' => 'required|alpha_num|unique:users',
        'show_us_nombre' => 'required|alpha',
        'show_us_apellido' => 'required|alpha',
        'show_us_rut' => 'required|size:10',
        'show_us_telefono' => 'required|numeric',
        'show_us_email' => 'required|email|unique:users'
    ];

    protected $messages = [
        'show_us_username.required' => 'El campo de Usuario es obligatorio',
        'show_us_username.alpha_num' => 'El campo de Usuario debe ser en formato alfanumérico',
        'show_us_username.unique' => 'El nombre de usuario especificado ya esta en uso',
        'show_us_nombre.required' => 'El campo de Nombre es obligatorio',
        'show_us_nombre.alpha' => 'El campo de nombre debe ser en formato alfabético',
        'show_us_apellido.required' => 'El campo de Apellido es obligatorio',
        'show_us_apellido.alpha' => 'El campo de Apellido debe ser en formato alfabético',
        'show_us_rut.required' => 'El campo de Rut es obligatorio',
        'show_us_rut.size' => 'El campo de Rut no puede pasar los 10 caracteres',
        'show_us_telefono.required' => 'El campo de Teléfono es obligatorio',
        'show_us_telefono.numeric' => 'El campo de Teléfono debe ser solo numérico',
        'show_us_email.required' => 'El campo de Email es obligatorio',
        'show_us_email.email' => 'El campo de Email debe tener formato email@email.xx',
        'show_us_email.unique' => 'La dirección de correo ya esta en uso por otro usuario'
    ];

    public function updateEmpleado()
    {
        $this->validate();

        $this->empleado->us_username = $this->show_us_username;
        $this->empleado->us_nombre = $this->show_us_nombre;
        $this->empleado->us_apellido = $this->show_us_apellido;
        $this->empleado->us_rut = $this->show_us_rut;
        $this->empleado->us_telefono = $this->show_us_telefono;
        $this->empleado->us_email = $this->show_us_email;

        $this->empleado->save();
        toast()->info('Empleado actualizado con éxito!')->push();
        return redirect()->back();

    }
}
