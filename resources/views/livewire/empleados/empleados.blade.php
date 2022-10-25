<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Mantenedor de empleados') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <div class="justify-self-start">
                        @can('users_create')
                            <x-jet-button wire:click="$toggle('modalCreacion')">{{ __('Crear') }}</x-jet-button>
                        @endcan
                    </div>
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
                        <input wire:model='filtro' class="block p-2 pl-10 w-80 border border-gray-300" type="text"
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
                                Estado
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
                            <td class="py-3 px-6">{{ $empleado->us_estado }}</td>
                            <td class="py-3 px-6">
                                @can('users_edit')
                                    <x-jet-button wire:click='confirmEmpleadoEdicion ({{ $empleado->id }})' wire:loading.attr='disabled' class="m-1">{{ __('Editar') }}</x-jet-button>
                                @endcan
                                @if($empleado->us_estado == 'activo')
                                    @can('users_delete')
                                        <x-jet-danger-button wire:click='confirmEmpleadoDeshabilitacion ({{ $empleado->id }})' wire:loading.attr='disabled' class="m-1">{{ __('Deshabilitar') }}</x-jet-danger-button>
                                    @endcan
                                @else
                                    <x-jet-danger-button class="m-1">{{ _('Habilitar') }}</x-jet-danger-button>
                                @endif
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
                    No hay resultados para la búsqueda "{{ $filtro }}"
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal de confirmación de suspension de usuario --}}
    <x-jet-confirmation-modal wire:model='modalDeshabilitacion'>
        <x-slot name="title">
            {{ _('Deshabilitar usuario') }}
        </x-slot>
        <x-slot name="content">
            {{ _('Desea deshabilitar el acceso a la plataforma del usuario seleccionado? Esta acción no puede ser deshecha') }}
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelDeshabilitar" class="m-1">
                {{ _('Cancelar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click='deshabilitarEmpleado ({{ $modalDeshabilitacion }})' class="m-1">
                {{ _('Deshabilitar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    {{-- Modal de creación de usuario --}}
    <x-jet-dialog-modal wire:model='modalCreacion'>
        <x-slot name="title">
            {{ _('Añadir nuevo usuario') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent='submit' class="space-y-4">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-jet-label for="us_username" value="{{ __('Usuario') }}" />
                        <x-jet-input id="us_username" wire:model='us_username' type="text" placeholder="Username" class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_username" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_rut" value="{{ __('Rut') }}" />
                        <x-jet-input id="us_rut" wire:model='us_rut' wire:change="formatRut" wire:keyup="formatRut" type="text" placeholder='11222333-4' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_rut" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="us_nombre" wire:model='us_nombre' type="text" placeholder='John' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_nombre" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_apellido" value="{{ __('Apellido') }}" />
                        <x-jet-input id="us_apellido" wire:model='us_apellido' type="text" placeholder='Doe' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_apellido" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_telefono" value="{{ __('Telefono') }}" />
                        <x-jet-input id="us_telefono" wire:model='us_telefono' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_telefono" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_email" value="{{ __('Email') }}" />
                        <x-jet-input id="us_email" wire:model='us_email' type="email" placeholder='user@controlsim.cl' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_email" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                        <x-jet-input id="password" wire:model='password' type="password" placeholder='********' class="mt-1 block w-full"/>
                        <x-jet-input-error for="password" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cargo" value="{{ __('Cargo') }}" />
                        <select name="cargo" id="cargo" wire:model='cargo' default=''
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mt-1 w-full p-2.5"
                            value=''>
                            <option selected value="cargo">cargo</option>
                            @foreach ($roles as $rol)
                                @if ($rol!='super-admin')
                                    <option value="{{ $rol }}">{{ $rol }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="cargo" class="mt-2" />
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelCrear" class="m-1">
                {{ _('Cancelar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button type='submit' wire:click='submit' class="m-1">
                {{ _('Crear') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model='modalEdicion'>
        <x-slot name="title">
            {{ _('Editar usuario') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent='submit' class="space-y-4">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-jet-label for="us_username" value="{{ __('Usuario') }}" />
                        <x-jet-input id="us_username" wire:model='us_username' type="text" placeholder="Username" class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_username" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_rut" value="{{ __('Rut') }}" />
                        <x-jet-input id="us_rut" wire:model='us_rut' wire:change="formatRut" wire:keyup="formatRut" type="text" placeholder='11222333-4' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_rut" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="us_nombre" wire:model='us_nombre' type="text" placeholder='John' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_nombre" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_apellido" value="{{ __('Apellido') }}" />
                        <x-jet-input id="us_apellido" wire:model='us_apellido' type="text" placeholder='Doe' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_apellido" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_telefono" value="{{ __('Telefono') }}" />
                        <x-jet-input id="us_telefono" wire:model='us_telefono' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_telefono" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="us_email" value="{{ __('Email') }}" />
                        <x-jet-input id="us_email" wire:model='us_email' type="email" placeholder='user@controlsim.cl' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_email" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                        <x-jet-input id="password" wire:model='password' type="password" placeholder='********' class="mt-1 block w-full"/>
                        <x-jet-input-error for="password" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cargo" value="{{ __('Cargo') }}" />
                        <select name="cargo" id="cargo" wire:model='cargo'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mt-1 w-full p-2.5">
                            @foreach ($roles as $rol)
                                @if ($rol != 'super-admin')
                                    @if ($rol == $this->cargo)
                                        <option selected value="{{ $rol }}">{{ $rol }}</option>
                                    @else
                                        <option value="{{ $rol }}">{{ $rol }}</option>
                                    @endif
                                @else
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="cargo" class="mt-2" />
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelEditar" class="m-1">
                {{ _('Cancelar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button type='submit' wire:click='update' class="m-1">
                {{ _('Crear') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
