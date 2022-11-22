<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Mantenedor de clientes') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <div class="justify-self-start">
                        @can('clientes_create')
                            <x-jet-button wire:click="$toggle('modalCreacionCliente')">{{ __('Crear') }}</x-jet-button>
                        @endcan
                    </div>
                    <label for="search_clientes" class="sr-only">Buscar</label>
                    <div class="relative justify-self-end">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model='filtro_cli' class="block p-2 pl-10 w-80 border border-gray-300" type="text"
                            name="search_clientes" id="search_clientes" placeholder="Buscar clientes">
                    </div>
                </div>
                <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                Rut
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Nombre
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Razón Social
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
                        @foreach ($clientes as $cliente)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ $cliente->cli_rut }}</td>
                            <td class="py-3 px-6">{{ $cliente->cli_nombre }}</td>
                            <td class="py-3 px-6">{{ $cliente->cli_razonsocial }}</td>
                            <td class="py-3 px-6">{{ $cliente->cli_email }}</td>
                            <td class="py-3 px-6">{{ $cliente->cli_ciudad }}</td>
                            <td class="py-3 px-6">
                                @can('clientes_edit')
                                    <a href="/clientes/{{ $cliente->id }}"><x-jet-button>{{ __('Ver') }}</x-jet-button></a>
                                @endcan
                                {{-- @if($cliente->cli_estado == 'activo')
                                    @can('users_delete')
                                        <x-jet-danger-button wire:click='confirmclienteDeshabilitacion ({{ $cliente->id }})' wire:loading.attr='disabled' class="m-1">{{ __('Deshabilitar') }}</x-jet-danger-button>
                                    @endcan
                                @else
                                    <x-jet-danger-button class="m-1">{{ _('Habilitar') }}</x-jet-danger-button>
                                @endif --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($clientes->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $clientes->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_cli }}"
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal de confirmación de suspension de usuario --}}
    {{-- <x-jet-confirmation-modal wire:model='modalDeshabilitacionCliente'>
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
            <x-jet-danger-button wire:click='deshabilitarCliente ({{ $modalDeshabilitacionCliente }})' class="m-1">
                {{ _('Deshabilitar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal> --}}

    {{-- Modal de creación de usuario --}}
    <x-jet-dialog-modal wire:model='modalCreacionCliente'>
        <x-slot name="title">
            {{ _('Añadir nuevo usuario') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent='submit' class="space-y-4">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-jet-label for="cli_rut" value="{{ __('Rut') }}" />
                        <x-jet-input id="cli_rut" wire:model='cli_rut' wire:change="formatRut" wire:keyup="formatRut" type="text" placeholder="11222333-4" class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_rut" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="cli_nombre" wire:model.lazy='cli_nombre' type="text" placeholder='Empresa ejemplo' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_rut" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_razonsocial" value="{{ __('Razón social') }}" />
                        <x-jet-input id="cli_razonsocial" wire:model.lazy='cli_razonsocial' type="text" placeholder='Empresa ejemplo SA' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_nombre" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_email" value="{{ __('Email') }}" />
                        <x-jet-input id="cli_email" wire:model.lazy='cli_email' type="email" placeholder='Doe' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_email" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_telefono" value="{{ __('Telefono') }}" />
                        <x-jet-input id="cli_telefono" wire:model.lazy='cli_telefono' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_telefono" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_direccion" value="{{ __('Direccion') }}" />
                        <x-jet-input id="cli_direccion" wire:model.lazy='cli_direccion' type="text" placeholder='user@controlsim.cl' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_direccion" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_comuna" value="{{ __('Comuna') }}" />
                        <x-jet-input id="cli_comuna" wire:model.lazy='cli_comuna' type="text" placeholder='********' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_comuna" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="cli_region" value="{{ __('Region') }}" />
                        <x-jet-input id="cli_region" wire:model.lazy='cli_region' type="text" placeholder='********' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_region" class="mt-2" />
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
</div>
