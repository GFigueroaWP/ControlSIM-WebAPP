<x-jet-confirmation-modal wire:model='modalHabilitacionEmpleado'>
    <x-slot name="title">
        {{ __('Habilitar usuario') }}
    </x-slot>
    <x-slot name="content">
        {{ __('¿Desea habilitar el acceso a la plataforma del usuario seleccionado?') }}
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="cancelHabilitar" class="m-1">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        <x-jet-button wire:click='habilitarEmpleado ({{ $modalHabilitacionEmpleado }})' class="m-1">
            {{ __('Habilitar') }}
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
