<x-jet-dialog-modal wire:model='modalCancelarTrabajo'>
    <x-slot name="title">
        {{ __('Cancelar Trabajo') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent='submitCancelar' class="space-y-4">
            @csrf
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                {{ __('¿Desea Cancelar la orden de trabajo?') }}
            </div>
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="col-span-6">
                    <x-jet-label for="add_observacion" value="{{ __('Observación') }}" />
                    <textarea id="add_observacion" wire:model='add_observacion' rows="5" type="text" placeholder='Observación'
                    class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-csim focus:border-csim disabled" ></textarea>
                    <x-jet-input-error for="add_observacion" class="mt-2" />
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelCancelar" class="m-1">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button type='submit' wire:click.prevent='submitCancelar' class="m-1">
            {{ __('Cancelar Orden') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
