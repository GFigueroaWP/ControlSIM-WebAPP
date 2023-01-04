<x-jet-confirmation-modal wire:model='modalEstadoCotizacion'>
    <x-slot name="title">
        {{ _('Actualizar cotización') }}
    </x-slot>
    <x-slot name="content">
        {{ _('¿Actualizar el estado de la cotizacion?') }}
        {{ _('(ADVERTENCIA: Esta accion no puede ser revertida)') }}
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelEstado" class="m-1">
            {{ _('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click="rechazarEstado" class="m-1">
            {{ _('Rechazada') }}
        </x-jet-danger-button>
        <x-jet-button wire:click="aceptarEstado" class="m-1">
            {{ _('Aceptada') }}
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
