<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lista de empleados Deshabilitados') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <label for="search_empleados" class="sr-only">Buscar</label>
                    <div class="relative justify-self-end">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model='filtro_us' class="block p-2 pl-10 w-80 border border-gray-300" type="text"
                            name="search_empleados" id="search_empleados" placeholder="Buscar Empleados">
                    </div>
                </div>
                <table class=" w-full text-base text-left">
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
                                @can('users_delete')
                                <x-jet-button wire:click='confirmEmpleadoHabilitacion ({{ $empleado->id }})'
                                    wire:loading.attr='disabled' class="m-1">{{ __('Habilitar') }}
                                </x-jet-button>
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
                @endif
            </div>
        </div>
    </div>

    {{-- Modal de confirmación de suspension de usuario --}}
    <x-jet-confirmation-modal wire:model='modalHabilitacionEmpleado'>
        <x-slot name="title">
            {{ _('Habilitar usuario') }}
        </x-slot>
        <x-slot name="content">
            {{ _('¿Desea habilitar el acceso a la plataforma del usuario seleccionado?') }}
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelHabilitar" class="m-1">
                {{ _('Cancelar') }}
            </x-jet-secondary-button>
            <x-jet-button wire:click='habilitarEmpleado ({{ $modalHabilitacionEmpleado }})' class="m-1">
                {{ _('Habilitar') }}
            </x-jet-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>