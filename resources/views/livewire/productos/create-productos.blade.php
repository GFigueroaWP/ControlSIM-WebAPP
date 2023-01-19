<x-jet-dialog-modal wire:model='modalCreacionProducto'>
    <x-slot name="title">
        {{ __('Añadir nuevo producto o servicio') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent='submitProducto' class="space-y-4">
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
                    <x-jet-input id="prod_valor" wire:model='prod_valor' type="text" placeholder='10000'
                        class="mt-1 block w-full" />
                    <x-jet-input-error for="prod_valor" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <x-jet-label for="prod_detalle" value="{{ __('Descripcion') }}" />
                    <textarea id="prod_detalle" wire:model='prod_detalle' rows="5" type="text" placeholder='Descripción'
                    class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-csim focus:border-csim" ></textarea>
                    <x-jet-input-error for="prod_detalle" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelCrearProducto" class="m-1">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-button type='submit' wire:click='submitProducto' class="m-1">
            {{ __('Crear') }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
