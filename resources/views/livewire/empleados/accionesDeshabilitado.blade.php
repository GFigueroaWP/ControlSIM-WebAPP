<x-jet-button wire:click="$emit('confirmEmpleadoHabilitacion',{{ $empleado->id }})"
    wire:loading.attr='disabled' class="m-1">{{ __('Habilitar') }}
</x-jet-button>
