<x-jet-confirmation-modal wire:model='modalEstadoCotizacion'>
    <x-slot name="title">
        {{ __('Actualizar cotización') }}
    </x-slot>
    <x-slot name="content">
        {{ __('¿Actualizar el estado de la cotizacion?') }}
        {{ __('(ADVERTENCIA: Esta accion no puede ser revertida)') }}
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelEstado" class="m-1">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="rechazarEstado" class="m-1">
            {{ __('Rechazada') }}
        </x-jet-danger-button>
        <x-jet-button wire:click="aceptarEstado" class="m-1">
            {{ __('Aceptada') }}
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
