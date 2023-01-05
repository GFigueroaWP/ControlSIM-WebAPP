<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/* Importación de los modelos de roles y permisos del paquete Spatie. */
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use \App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eliminar el cache de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // crear Permisos
        $permissions = [
            //Permisos de manejo de "Permisos"
            'permisos_create',
            'permisos_edit',
            'permisos_show',
            'permisos_delete',
            'permisos_access',
            //Permisos de manejo de "Roles"
            'roles_create',
            'roles_edit',
            'roles_show',
            'roles_delete',
            'roles_access',
            //Permisos de manejo de "Usuarios"
            'users_create',
            'users_edit',
            'users_show',
            'users_delete',
            'users_access',
            //Permisos de manejo de "Clientes"
            'clientes_create',
            'clientes_edit',
            'clientes_show',
            'clientes_delete',
            'clientes_access',
            //Permisos de manejo de "Contactos"
            'contactos_create',
            'contactos_edit',
            'contactos_show',
            'contactos_delete',
            'contactos_access',
            //Permisos de manejo de "Productos"
            'productos_create',
            'productos_edit',
            'productos_show',
            'productos_delete',
            'productos_access',
            //Permisos de manejo de "Proyectos"
            'proyectos_create',
            'proyectos_edit',
            'proyectos_show',
            'proyectos_delete',
            'proyectos_access',
            //Permisos de manejo de "Cotizaciones"
            'cotizaciones_create',
            'cotizaciones_edit',
            'cotizaciones_show',
            'cotizaciones_delete',
            'cotizaciones_access',
            //Permisos de manejo de "Ordenes"
            'ordenes_create',
            'ordenes_edit',
            'ordenes_show',
            'ordenes_delete',
            'ordenes_access',
            //Permisos de manejo de "Trabajos propios"
            'trabajos_create',
            'trabajos_edit',
            'trabajos_show',
            'trabajos_delete',
            'trabajos_access',
            //Permisos de manejo de "Comentarios"
            'comentarios_create',
            'comentarios_edit',
            'comentarios_show',
            'comentarios_delete',
            'comentarios_access',
            //Permisos de manejo de "Informes"
            'informes_create',
            'informes_edit',
            'informes_show',
            'informes_delete',
            'informes_access',
            //Permisos de manejo de "Tareas"
            'tareas_create',
            'tareas_edit',
            'tareas_show',
            'tareas_delete',
            'tareas_access',
            //Permisos de manejo de "Viáticos"
            'viaticos_create',
            'viaticos_edit',
            'viaticos_show',
            'viaticos_delete',
            'viaticos_access',
            //Permisos de manejo de "Boletas"
            'boletas_create',
            'boletas_edit',
            'boletas_show',
            'boletas_delete',
            'boletas_access',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // crear Roles y asignarles Permisos
        $role = Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'Administrativo'])->givePermissionTo(['users_create', 'users_edit', 'users_show', 'users_delete', 'users_access', 'clientes_create', 'clientes_edit', 'clientes_show', 'clientes_delete', 'clientes_access', 'contactos_create', 'contactos_edit', 'contactos_show', 'contactos_delete', 'contactos_access', 'cotizaciones_create', 'cotizaciones_edit', 'cotizaciones_show', 'cotizaciones_delete', 'cotizaciones_access', 'productos_create', 'productos_edit', 'productos_show', 'productos_delete', 'productos_access', 'proyectos_create', 'proyectos_edit', 'proyectos_show', 'proyectos_delete', 'proyectos_access', 'ordenes_create', 'ordenes_edit', 'ordenes_show', 'ordenes_delete', 'ordenes_access']);
        $role = Role::create(['name' => 'Tecnico'])->givePermissionTo(['trabajos_create', 'trabajos_edit', 'trabajos_show', 'trabajos_delete', 'trabajos_access', 'comentarios_create', 'comentarios_edit', 'comentarios_show', 'comentarios_delete', 'comentarios_access', 'informes_create', 'informes_edit', 'informes_show', 'informes_delete', 'informes_access', 'viaticos_create', 'viaticos_edit', 'viaticos_show', 'viaticos_delete', 'viaticos_access', 'boletas_create', 'boletas_edit', 'boletas_show', 'boletas_delete', 'boletas_access']);

        $super = User::create([
            'us_username' => 'Test',
            'us_nombre' => 'Test',
            'us_apellido' => 'User',
            'us_rut' => '112563598',
            'us_telefono' => '12345678',
            'us_email' => 'test@test.cl',
            'password' => Hash::make('test1234')
        ]);

        $super->assignRole('super-admin');
    }
}
