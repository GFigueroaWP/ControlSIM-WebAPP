<x-jet-dialog-modal wire:model='modalCreacionEmpleado'>
    <x-slot name="title">
        {{ _('Añadir nuevo usuario') }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent='submitEmpleado' class="space-y-4">
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
                <div>
                    <x-jet-label for="cargo" value="{{ __('Cargo') }}" />
                    <select name="cargo" id="cargo" wire:model.lazy='cargo' default=''
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
        <x-jet-danger-button type='submit' wire:click='submitEmpleado' class="m-1">
            {{ _('Crear') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
