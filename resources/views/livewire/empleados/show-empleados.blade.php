<x-jet-dialog-modal wire:model='modalMostrar'>
    <x-slot name="title">
        {{ _('Mostrando usuario') }}
    </x-slot>
    <x-slot name="content">
        {{ _('Desea deshabilitar el acceso a la plataforma del usuario seleccionado? Esta acción no puede ser deshecha') }}
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalMostrar')" wire:loading.attr='"disabled'>
            {{ _('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click='deshabilitarEmpleado ({{ $modalMostrar}})' wire:loading.attr='disabled'>
            {{ _('Deshabilitar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>
