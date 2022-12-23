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
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente }}">{{ $cliente->cli_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-button wire:click="$emit('crearCliente')" class="my-6">{{ __('Añadir nuevo cliente') }}</x-jet-button>
                                @livewire('clientes.create-clientes')
                            </div>
                            <div>
                                <x-jet-label for="nombre_cli" value="{{ __('Nombre del Cliente') }}" />
                                <x-jet-input type="" name="" id="" class=""></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="rut_cli" value="{{ __('Rut Cliente') }}" />
                                <x-jet-input type="" name="" id="" class=""></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="direccion_cli" value="{{ __('Direccion Cliente') }}" />
                                <x-jet-input type="" name="" id="" class=""></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="" value="" />
                                <x-jet-input type="" name="" id="" class=""></x-jet-input>
                            </div>
                        </div>
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
