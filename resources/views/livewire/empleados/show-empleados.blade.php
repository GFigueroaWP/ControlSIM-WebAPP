<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Información de empleado') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="updateEmpleado">
                <x-slot name="title">
                    {{ __('Información de empleado') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Información almacenada del empleado seleccionado') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_us_username" value="{{ __('Usuario') }}" />
                        <x-jet-input id="show_us_username" wire:model='show_us_username' type="text"
                            placeholder="Username" class="mt-1 block w-full" />
                        <x-jet-input-error for="show_us_username" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_us_rut" value="{{ __('Rut') }}" />
                        <x-jet-input id="show_us_rut" wire:model='show_us_rut' wire:change="formatRut"
                            wire:keyup="formatRut" type="text" placeholder='11222333-4' class="mt-1 block w-full"
                            disabled />
                        <x-jet-input-error for="show_us_rut" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_us_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="show_us_nombre" wire:model='show_us_nombre' type="text" placeholder='John'
                            class="mt-1 block w-full" />
                        <x-jet-input-error for="show_us_nombre" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_us_apellido" value="{{ __('Apellido') }}" />
                        <x-jet-input id="show_us_apellido" wire:model='show_us_apellido' type="text" placeholder='Doe'
                            class="mt-1 block w-full" />
                        <x-jet-input-error for="show_us_apellido" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_us_telefono" value="{{ __('Telefono') }}" />
                        <x-jet-input id="show_us_telefono" wire:model='show_us_telefono' type="text"
                            placeholder='912344678' class="mt-1 block w-full" />
                        <x-jet-input-error for="show_us_telefono" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_us_email" value="{{ __('Email') }}" />
                        <x-jet-input id="show_us_email" wire:model='show_us_email' type="email"
                            placeholder='user@controlsim.cl' class="mt-1 block w-full" />
                        <x-jet-input-error for="show_us_email" class="mt-2" />
                    </div>
                </x-slot>
                <x-slot name="actions">
                    <x-jet-button type="submit">{{ __('editar') }}</x-jet-button>
                </x-slot>
            </x-jet-form-section>
        </div>
    </div>
</div>
