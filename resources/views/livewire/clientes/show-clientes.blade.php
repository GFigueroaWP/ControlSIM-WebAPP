<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Información de cliente') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="updateCliente">
                <x-slot name="title">
                    {{ __('Información de cliente') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Informacion almacenada del cliente seleccionado') }}
                </x-slot>
                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_rut" value="{{ __('Rut') }}" />
                        <x-jet-input id="cli_rut" wire:model='cli_rut' wire:change="formatRut" wire:keyup="formatRut" type="text" placeholder="11222333-4" class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_rut" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="cli_nombre" wire:model.lazy='cli_nombre' type="text" placeholder='Nombre empresa' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_nombre" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_razonsocial" value="{{ __('Razón social') }}" />
                        <x-jet-input id="cli_razonsocial" wire:model.lazy='cli_razonsocial' type="text" placeholder='Empresa ejemplo SA' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_razonsocial" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_giro" value="{{ __('Giro') }}" />
                        <x-jet-input id="cli_giro" wire:model.lazy='cli_giro' type="text" placeholder='Giro' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_giro" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_email" value="{{ __('Email') }}" />
                        <x-jet-input id="cli_email" wire:model.lazy='cli_email' type="email" placeholder='empresa@email.cl' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_email" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_telefono" value="{{ __('Telefono') }}" />
                        <x-jet-input id="cli_telefono" wire:model.lazy='cli_telefono' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_telefono" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_direccion" value="{{ __('Direccion') }}" />
                        <x-jet-input id="cli_direccion" wire:model.lazy='cli_direccion' type="text" placeholder='calle 123' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_direccion" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_comuna" value="{{ __('Comuna') }}" />
                        <x-jet-input id="cli_comuna" wire:model.lazy='cli_comuna' type="text" placeholder='comuna' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_comuna" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cli_region" value="{{ __('Region') }}" />
                        <x-jet-input id="cli_region" wire:model.lazy='cli_region' type="text" placeholder='region' class="mt-1 block w-full"/>
                        <x-jet-input-error for="cli_region" class="mt-2" />
                    </div>
                </x-slot>
                <x-slot name="actions">

                </x-slot>
            </x-jet-form-section>

            <x-jet-section-border />

            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Contactos') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Crea y administra contactos para el cliente visualizado') }}
                </x-slot>
                <x-slot name="content">
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <table class=" w-full text-base text-left" >
                            <thead class="uppercase">
                                <tr>
                                    <th scope="col" class="py-2 px-6">
                                        Nombre
                                    </th>
                                    <th scope="col" class="py-2 px-6">
                                        Correo
                                    </th>
                                    <th scope="col" class="py-2 px-6">
                                        Telefono
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactos as $contacto)
                                    <tr class="bg-white border-b hover:bg-gray-300">
                                        <td class="py-3 px-6">{{ $contacto->con_nombre }}</td>
                                        <td class="py-3 px-6">{{ $contacto->con_email }}</td>
                                        <td class="py-3 px-6">{{ $contacto->con_telefono }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex items-center mt-5">
                            <x-jet-button wire:click="$emit('crearContacto')">Crear contacto</x-jet-button>
                        </div>
                    </div>
                </x-slot>
            </x-jet-action-section>

            @livewire('clientes.create-contactos', ['cli_id' => $cliente->id])
        </div>
    </div>
</div>
