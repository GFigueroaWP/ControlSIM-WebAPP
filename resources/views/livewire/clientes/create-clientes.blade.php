<x-jet-dialog-modal wire:model='modalCreacionCliente'>
    <x-slot name="title">
        {{ _('Añadir nuevo usuario') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent='submitCliente' class="space-y-4">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-jet-label for="cli_rut" value="{{ __('Rut') }}" />
                    <x-jet-input id="cli_rut" wire:model='cli_rut' wire:change="formatRut" type="text"
                        placeholder="11.222.333-4" class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_rut" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_razonsocial" value="{{ __('Razón social') }}" />
                    <x-jet-input id="cli_razonsocial" wire:model.lazy='cli_razonsocial' type="text"
                        placeholder='Empresa ejemplo SA' class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_razonsocial" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_giro" value="{{ __('Giro') }}" />
                    <x-jet-input id="cli_giro" wire:model.lazy='cli_giro' type="text" placeholder='Giro'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_giro" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_email" value="{{ __('Email') }}" />
                    <x-jet-input id="cli_email" wire:model.lazy='cli_email' type="email" placeholder='empresa@email.cl'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_email" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_telefono" value="{{ __('Telefono') }}" />
                    <x-jet-input id="cli_telefono" wire:model.lazy='cli_telefono' type="text" placeholder='912344678'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_telefono" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_direccion" value="{{ __('Direccion') }}" />
                    <x-jet-input id="cli_direccion" wire:model.lazy='cli_direccion' type="text" placeholder='Calle 123'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_direccion" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_comuna" value="{{ __('Comuna') }}" />
                    <x-jet-input id="cli_comuna" wire:model.lazy='cli_comuna' type="text" placeholder='Comuna'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_comuna" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="cli_ciudad" value="{{ __('Ciudad') }}" />
                    <x-jet-input id="cli_ciudad" wire:model.lazy='cli_ciudad' type="text" placeholder='Ciudad'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="cli_ciudad" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelCrear" class="m-1">
            {{ _('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-button type='submit' wire:click='submitCliente' class="m-1">
            {{ _('Crear') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
