<x-jet-dialog-modal wire:model='modalEdicionProducto'>
    <x-slot name="title">
        {{ _('Añadir nuevo producto o servicio') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent='editProducto' class="space-y-4">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div>
                    <x-jet-label for="prod_nombre" value="{{ __('Nombre') }}" />
                    <x-jet-input id="prod_nombre" wire:model.lazy='prod_nombre' type="text" placeholder="Producto/Servicio"
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="prod_nombre" class="mt-2" />
                </div>
                <div>
                    <x-jet-label for="prod_valor" value="{{ __('Precio') }}" />
                    <x-jet-input id="prod_valor" wire:model.lazy='prod_valor' type="text" placeholder='10000'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="prod_valor" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelEditarProducto" class="m-1">
            {{ _('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-button type='submit' wire:click='editProducto' class="m-1">
            {{ _('Editar') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
