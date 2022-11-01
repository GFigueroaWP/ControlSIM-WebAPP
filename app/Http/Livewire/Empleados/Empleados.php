<?php

namespace App\Http\Livewire\Empleados;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\States\User\Deshabilitado;
use Spatie\Permission\Models\Role;

class Empleados extends Component
{
    use WithPagination;

    public $filtro;
    public $modalDeshabilitacion = false;
    public $modalMostrar = false;
    public $modalCreacion = false;
    public $modalEdicion = false;
    public $edit, $selected_id;

    public function render()
    {
        $filtro = '%'.$this->filtro .'%';

        return view('livewire.empleados.empleados', [
            'empleados' => User::latest()
                        ->orWhere('us_nombre','LIKE',$filtro)
                        ->orWhere('us_apellido','LIKE',$filtro)
                        ->orWhere('us_username','LIKE',$filtro)
                        ->paginate(10),
            'roles' => Role::all()->pluck('name')
        ]);
    }

    public function confirmEmpleadoDeshabilitacion ($id){
        $this->modalDeshabilitacion = $id;
    }

    public function cancelDeshabilitar (){
        $this->modalDeshabilitacion = false;
    }

    public function cancelCrear (){
        $this->modalCreacion = false;
    }

    public function cancelEditar (){
        $this->modalEdicion = false;
    }

    public function deshabilitarEmpleado (User $empleado){
        $empleado->us_estado->transitionTo(Deshabilitado::class);
        $this->modalDeshabilitacion = false;
    }

    public $us_username, $us_nombre, $us_apellido, $us_rut,
        $us_telefono, $us_email, $password, $cargo;

    public function formatRut()
    {
        $us_rut = $this-> us_rut;
        $us_rut = preg_replace('/[^0-9]+/', '', $us_rut);
        $us_rut = substr($us_rut, 0, 9);
        $length = strlen($us_rut);
        $formatted = "";
        for ($i = 0; $i < $length; $i++) {
            $formatted .= $us_rut[$i];
            if($length == 8 && $i == 6){
                $formatted .= "-";
            }
            if($length == 9 && $i == 7){
                $formatted .= "-";
            }
        }
        $this->us_rut = $formatted;
    }

    protected $rules = [
        'us_username' => 'required|alpha_num|unique:users',
        'us_nombre' => 'required|alpha',
        'us_apellido' => 'required|alpha',
        'us_rut' => 'required|size:10',
        'us_telefono' => 'required|numeric',
        'us_email' => 'required|email|unique:users',
        'password' => 'required',
        'cargo' =>  'exists:roles,name'
    ];

    protected $messages = [
        'us_username.required' => 'El campo de Usuario es obligatorio',
        'us_username.alpha_num' => 'El campo de Usuario debe ser en formato alfanumérico',
        'us_username.unique' => 'El nombre de usuario especificado ya esta en uso',
        'us_nombre.required' => 'El campo de Nombre es obligatorio',
        'us_nombre.alpha' => 'El campo de nombre debe ser en formato alfabético',
        'us_apellido.required' => 'El campo de Apellido es obligatorio',
        'us_apellido.alpha' => 'El campo de Apellido debe ser en formato alfabético',
        'us_rut.required' => 'El campo de Rut es obligatorio',
        'us_rut.size' => 'El campo de Rut no puede pasar los 10 caracteres',
        'us_telefono.required' => 'El campo de Teléfono es obligatorio',
        'us_telefono.numeric' => 'El campo de Teléfono debe ser solo numérico',
        'us_email.required' => 'El campo de Email es obligatorio',
        'us_email.email' => 'El campo de Email debe tener formato email@email.xx',
        'us_email.unique' => 'La dirección de correo ya esta en uso por otro usuario',
        'password.required' => 'El campo de Contraseña es obligatorio',
        'cargo.exists' => 'El cargo seleccionado no se encuentra en los registros'
    ];

    public function submit()
    {
        $this->validate();
        User::create([
            'us_username' => $this->us_username,
            'us_nombre' => $this->us_nombre,
            'us_apellido' => $this->us_apellido,
            'us_rut' => $this->us_rut,
            'us_telefono' => $this->us_telefono,
            'us_email' => $this->us_email,
            'password' => Hash::make($this->password)
        ])->assignRole($this->cargo);
        session()->flash('flash.banner', 'Nuevo usuario añadido con éxito');
        session()->flash('flash.bannerStyle', 'success');
        $this->modalCreacion = false;
        return redirect()->to('/empleados');
    }

    public function confirmEmpleadoEdicion ($id){
        $edit = User::findOrFail($id);

        $this->selected_id = $id;
        $this->us_username = $edit->us_username;
        $this->us_nombre = $edit->us_nombre;
        $this->us_apellido = $edit->us_apellido;
        $this->us_rut = $edit->us_rut;
        $this->us_telefono = $edit->us_telefono;
        $this->us_email = $edit->us_email;
        $this->password = $edit->us_password;
        $this->cargo = $edit->getRoleNames()->first();

        $this->modalEdicion = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->selected_id) {
			$record = User::find($this->selected_id);
            $record->update([
                'us_username' => $this->us_username,
                'us_nombre' => $this->us_nombre,
                'us_apellido' => $this->us_apellido,
                'us_rut' => $this->us_rut,
                'us_telefono' => $this->us_telefono,
                'us_email' => $this->us_email,
                'password' => Hash::make($this->password)
            ])->assignRole($this->cargo);

            session()->flash('flash.banner', 'Nuevo usuario añadido con éxito');
            session()->flash('flash.bannerStyle', 'success');
            $this->modalEdicion = false;
            return redirect()->to('/empleados');
        }
    }
}
