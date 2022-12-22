<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear nueva cotizacion') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                {{-- <select name="cot_cliente" id="cot_cliente" wire:model='cot_cliente' wire:change='fillcot'>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->cli_nombre }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model='mostrar_id'> --}}
                <div class="relative shadow-md sm:rounded-lg p-5">
                    <form wire:submit.prevent='submitCotizacion' class="space-y-4">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <x-jet-label for="cot_cliente" value="{{ __('Seleccione Cliente') }}" />
                                <select name="cot_cliente" id="cot_cliente" wire:model='cot_cliente' wire:change='fillcot' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mt-1 w-full p-2.5">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->cli_nombre }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-button wire:click="$emit('crearCliente')" class="my-7">{{ __('Añadir nuevo cliente') }}</x-jet-button>
                                @livewire('clientes.create-clientes')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
