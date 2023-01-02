<x-jet-dialog-modal wire:model='modalCreacionItem'>
    <x-slot name="title">
        {{ _('Añadir nuevo producto o servicio') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent='submitItem' class="space-y-4">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-jet-label for="it_nombre" value="{{ __('Nombre') }}" />
                    <x-jet-input id="it_nombre" wire:model.lazy='it_nombre' type="text" placeholder="Producto/Servicio"
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="it_nombre" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="it_valor" value="{{ __('Precio') }}" />
                    <x-jet-input id="it_valor" wire:model='it_valor' type="text" placeholder='10000'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="it_valor" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelCrearItem" class="m-1">
            {{ _('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button type='submit' wire:click='submitItem' class="m-1">
            {{ _('Crear') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
