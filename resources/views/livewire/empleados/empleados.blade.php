<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de empleados') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <div class="justify-self-start">
                        @can('users_create')
                        <x-jet-button wire:click="$emit('crearEmpleado')">{{ __('Crear nuevo usuario') }}</x-jet-button>
                        @endcan
                    </div>
                    <div class="relative justify-self-end">
                        @can('users_access')
                        <a href="{{ route('empleadosDeshabilitados') }}"><x-jet-secondary-button>{{ __('Ver Deshabilitados') }}</x-jet-secondary-button></a>
                        @endcan
                    </div>
                    <div class="relative justify-self-end">
                        @can('users_access')
                        <x-jet-button wire:click="exportEmpleado">{{ __('Exportar Empleados') }}</x-jet-button>
                        @endcan
                    </div>
                </div>
                <div class="m-5">
                    <livewire:empleados.empleado-table />
                </div>
                {{-- <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                Rut
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Username
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Nombre
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Cargo
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ $empleado->us_rut }}</td>
                            <td class="py-3 px-6">{{ $empleado->us_username }}</td>
                            <td class="py-3 px-6">{{ $empleado->us_nombre }} {{ $empleado->us_apellido}}</td>
                            <td class="py-3 px-6">{{ $empleado->getRoleNames()->first() }}</td>
                            <td class="py-3 px-6">
                                @can('users_edit')
                                <a href="{{ route('showEmpleados', ['empleado' => $empleado->id]) }}">
                                    <x-jet-button>{{ __('Ver') }}</x-jet-button>
                                </a>
                                @endcan
                                @can('users_delete')
                                <x-jet-danger-button wire:click='confirmEmpleadoDeshabilitacion ({{ $empleado->id }})'
                                    wire:loading.attr='disabled' class="m-1">{{ __('Deshabilitar') }}
                                </x-jet-danger-button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($empleados->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $empleados->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_us }}"
                </div>
                @endif --}}
            </div>
        </div>
    </div>


    {{-- Modal de confirmación de suspension de usuario --}}
    <x-jet-confirmation-modal wire:model='modalDeshabilitacionEmpleado'>
        <x-slot name="title">
            {{ __('Deshabilitar usuario') }}
        </x-slot>
        <x-slot name="content">
            {{ __('¿Desea deshabilitar el acceso a la plataforma del usuario seleccionado?') }}
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDeshabilitar" class="m-1">
                {{ __('Cancelar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click='deshabilitarEmpleado ({{ $modalDeshabilitacionEmpleado }})' class="m-1">
                {{ __('Deshabilitar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    {{-- Modal de creación de usuario --}}
    @livewire('empleados.create-empleados')
</div>
