<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear nueva cotizacion') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="relative shadow-md sm:rounded-lg p-5">
                    <form wire:submit.prevent='submitCotizacion' class="space-y-4">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div wire:ignore>
                                <x-jet-label for="cot_cliente" value="{{ __('Seleccione Cliente') }}" />
                                <select name="cot_cliente" id="cot_cliente" class="select2">
                                    <option>Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->cli_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-button wire:click="$emit('crearCliente')" class="my-6">{{ __('Añadir nuevo cliente') }}</x-jet-button>
                                @livewire('clientes.create-clientes')
                            </div>
                            <div>
                                <x-jet-label for="razon_cli" value="{{ __('Razon social') }}" />
                                <x-jet-input type="text" name="razon_cli" id="razon_cli" wire:model="razon_cli" class=""></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="giro_cli" value="{{ __('Giro') }}" />
                                <x-jet-input type="text" name="giro_cli" id="giro_cli" wire:model="giro_cli" class=""></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="rut_cli" value="{{ __('Rut') }}" />
                                <x-jet-input type="text" name="rut_cli" id="rut_cli" wire:model="rut_cli" class=""></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="direccion_cli" value="{{ __('Direccion') }}" />
                                <x-jet-input type="text" name="direccion_cli" id="direccion_cli" wire:model="direccion_cli" class="" ></x-jet-input>
                            </div>
                        </div>
                        @if ($showContinuacion)
                            <div>
                                continuacion
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Seleccione un cliente'
        });
        $('.select2').on('change', function(e) {
            @this.set('select_id', $(this).val())
            @this.fillCliente()
        })
    });
</script>
@endsection
