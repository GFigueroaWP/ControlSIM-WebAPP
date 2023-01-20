<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery ,ShouldAutoSize, WithMapping, WithHeadings
{
    public function query(){
        return User::withTrashed()->with('roles');
    }

    public function headings(): array{
        return [
            'ID empleado',
            'Rut',
            'Nombre de usuario',
            'Nombre',
            'Apellido',
            'Email',
            'Telefono',
            'Cargo',
            'Creado',
            'Modificado',
            'Deshabilitado'
        ];
    }

    public function map($user): array{
        return[
            $user->id,
            $user->us_rut,
            $user->us_username,
            $user->us_nombre,
            $user->us_apellido,
            $user->us_email,
            $user->us_telefono,
            $user->getRoleNames()->first(),
            $user->created_at,
            $user->updated_at,
            $user->deleted_at,
        ];
    }
}
