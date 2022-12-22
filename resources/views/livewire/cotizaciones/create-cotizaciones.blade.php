<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear nueva cotizacion') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <select name="cot_cliente" id="cot_cliente" wire:model='cot_cliente' wire:change='fillcot'>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->cli_nombre }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model='mostrar_id'>
            </div>
        </div>
    </div>
</div>

{{-- <x-jet-dialog-modal wire:model='modalCreacionCotizacion'>
    <x-slot name="title">
        {{ _('Añadir nuevo usuario') }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent='submit' class="space-y-4">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-jet-label for="us_username" value="{{ __('Usuario') }}" />
                    <x-jet-input id="us_username" wire:model.lazy='us_username' type="text" placeholder="Username" class="mt-1 block w-full"/>
                    <x-jet-input-error for="us_username" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="us_rut" value="{{ __('Rut') }}" />
                    <x-jet-input id="us_rut" wire:model='us_rut' wire:change="formatRut" wire:keyup="formatRut" type="text" placeholder='11222333-4' class="mt-1 block w-full"/>
                    <x-jet-input-error for="us_rut" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="us_nombre" value="{{ __('Nombre') }}" />
                    <x-jet-input id="us_nombre" wire:model.lazy='us_nombre' type="text" placeholder='John' class="mt-1 block w-full"/>
                    <x-jet-input-error for="us_nombre" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="us_apellido" value="{{ __('Apellido') }}" />
                    <x-jet-input id="us_apellido" wire:model.lazy='us_apellido' type="text" placeholder='Doe' class="mt-1 block w-full"/>
                    <x-jet-input-error for="us_apellido" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="us_telefono" value="{{ __('Telefono') }}" />
                    <x-jet-input id="us_telefono" wire:model.lazy='us_telefono' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                    <x-jet-input-error for="us_telefono" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="us_email" value="{{ __('Email') }}" />
                    <x-jet-input id="us_email" wire:model.lazy='us_email' type="email" placeholder='user@controlsim.cl' class="mt-1 block w-full"/>
                    <x-jet-input-error for="us_email" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                    <x-jet-input id="password" wire:model.lazy='password' type="password" placeholder='********' class="mt-1 block w-full"/>
                    <x-jet-input-error for="password" class="mt-2" />
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
--}}
