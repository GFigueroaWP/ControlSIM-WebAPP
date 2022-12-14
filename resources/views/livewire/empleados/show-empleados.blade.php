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
                    {{ $empleado->us_username }}
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="us_username" value="{{ __('Usuario') }}" />
                        <x-jet-input id="us_username" wire:ignore.self wire:model.lazy='us_username' value='{{ $empleado->us_username }}' type="text" placeholder="Username" class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_username" class="mt-2" />
                    </div>
                    {{-- <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="us_rut" value="{{ __('Rut') }}" />
                        <x-jet-input id="us_rut" wire:model.defer='us_rut' wire:change="formatRut" wire:keyup="formatRut" value='{{ $empleado->us_rut }}' type="text" placeholder='11222333-4' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_rut" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="us_nombre" value="{{ __('Nombre') }}" />
                        <x-jet-input id="us_nombre" wire:model.defer='us_nombre' value='{{ $empleado->us_nombre }}' type="text" placeholder='John' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_nombre" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="us_apellido" value="{{ __('Apellido') }}" />
                        <x-jet-input id="us_apellido" wire:model.defer='us_apellido' value='{{ $empleado->us_apellido }}' type="text" placeholder='Doe' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_apellido" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="us_telefono" value="{{ __('Telefono') }}" />
                        <x-jet-input id="us_telefono" wire:model.defer='us_telefono' value='{{ $empleado->us_telefono }}' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_telefono" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="us_email" value="{{ __('Email') }}" />
                        <x-jet-input id="us_email" wire:model.defer='us_email' value='{{ $empleado->us_email }}' type="email" placeholder='user@controlsim.cl' class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_email" class="mt-2" />
                    </div>
                    <div>
                        <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                        <x-jet-input id="password" wire:model='password' type="password" placeholder='********' class="mt-1 block w-full"/>
                        <x-jet-input-error for="password" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cargo" value="{{ __('Cargo') }}" />
                        <select name="cargo" id="cargo" wire:model='cargo'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mt-1 w-full p-2.5">
                            @foreach ($roles as $rol)
                                @if ($rol != 'super-admin')
                                    @if ($rol == $empleado->cargo)
                                        <option selected value="{{ $rol }}">{{ $rol }}</option>
                                    @else
                                        <option value="{{ $rol }}">{{ $rol }}</option>
                                    @endif
                                @else
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="cargo" class="mt-2" />
                    </div> --}}
                </x-slot>

                <x-slot name="actions">
                    <x-jet-button wire:click='confirmEmpleadoEdicion ({{ $empleado->id }})' wire:loading.attr='disabled'>{{ __('editar') }}</x-jet-button>
                </x-slot>
            </x-jet-form-section>
        </div>
    </div>
    {{-- Modal de creación de usuario --}}
    <x-jet-dialog-modal wire:model='modalEdicionEmpleado'>
        <x-slot name="title">
            {{ _('Editar usuario') }}
        </x-slot>
        <x-slot name="content">
            <form wire:submit.prevent='edit' class="space-y-4">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-jet-label for="us_username" value="{{ __('Usuario') }}" />
                        <x-jet-input id="us_username" wire:model.lazy='us_username' type="text" placeholder="Username" class="mt-1 block w-full"/>
                        <x-jet-input-error for="us_username" class="mt-2" />
                    </div>
                </div>
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancelEditar" class="m-1">
                {{ _('Cancelar') }}
            </x-jet-secondary-button>
            <x-jet-danger-button type='submit' wire:click='edit' class="m-1">
                {{ _('Editar') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
