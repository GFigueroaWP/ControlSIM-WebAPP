    <a href="{{ route('showEmpleados', ['empleado' => $empleado->id]) }}">
        <x-jet-button>{{ __('Ver') }}</x-jet-button>
    </a>
@if ($empleado->id != auth()->user()->id)
    <x-jet-danger-button wire:click="$emit('confirmEmpleadoDeshabilitacion',{{ $empleado->id }})"
        wire:loading.attr='disabled' class="m-1">{{ __('Deshabilitar') }}
    </x-jet-danger-button>
@endif


