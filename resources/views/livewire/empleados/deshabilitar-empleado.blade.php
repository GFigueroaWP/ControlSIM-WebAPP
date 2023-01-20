<x-jet-confirmation-modal wire:model='modalDeshabilitacionEmpleado'>
    <x-slot name="title">
        {{ __('Deshabilitar usuario') }}
    </x-slot>
    <x-slot name="content">
        {{ __('¿Desea deshabilitar el acceso a la plataforma del usuario seleccionado?') }}
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelDeshabilitar" class="m-1">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-danger-button wire:click='deshabilitarEmpleado ({{ $modalDeshabilitacionEmpleado }})' class="m-1">
            {{ __('Deshabilitar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
