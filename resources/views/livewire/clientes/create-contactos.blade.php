<x-jet-dialog-modal wire:model='modalCreacionContacto'>
    <x-slot name="title">
        {{ _('Añadir nuevo contacto') }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent='submit' class="space-y-4">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-jet-label for="con_nombre" value="{{ __('Nombre') }}" />
                    <x-jet-input id="con_nombre" wire:model.lazy='con_nombre' type="text" placeholder='Contacto ejemplo' class="mt-1 block w-full"/>
                    <x-jet-input-error for="con_nombre" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="con_email" value="{{ __('Email') }}" />
                    <x-jet-input id="con_email" wire:model.lazy='con_email' type="email" placeholder='contacto@email.cl' class="mt-1 block w-full"/>
                    <x-jet-input-error for="cli_email" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="con_telefono" value="{{ __('Telefono') }}" />
                    <x-jet-input id="con_telefono" wire:model.lazy='con_telefono' type="text" placeholder='912344678' class="mt-1 block w-full"/>
                    <x-jet-input-error for="con_telefono" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalCreacionContacto')" class="m-1">
            {{ _('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-button type='submit' wire:click='submitContacto' class="m-1">
            {{ _('Crear') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
