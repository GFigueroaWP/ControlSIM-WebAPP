<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Cotizaciones') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <div class="justify-self-start">
                        @can('cotizaciones_create')
                            <a href="{{ route('createCotizaciones') }}"><x-jet-button>{{ __('Crear cotizacion') }}</x-jet-button></a>
                        @endcan
                    </div>
                    <label for="search_cotizacion" class="sr-only">Buscar</label>
                    <div class="relative justify-self-end">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model='filtro_cot' class="block p-2 pl-10 w-80 border border-gray-300" type="text"
                            name="search_cotizacion" id="search_cotizacion" placeholder="Buscar Cotizaciones">
                    </div>
                </div>
                <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                Cotizacion
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Cliente
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Emitida
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Estado
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Actualizada
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cotizaciones as $cotizacion)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ 'COT-'.str_pad($cotizacion->id,5,'0',STR_PAD_LEFT) }}</td>
                            <td class="py-3 px-6">{{ $cotizacion->cliente->cli_razonsocial }}</td>
                            <td class="py-3 px-6">{{ $cotizacion->created_at }}</td>
                            <td class="py-3 px-6">
                                <strong class="{{ $cotizacion->cot_estado }}">
                                    {{ $cotizacion->cot_estado }}
                                </strong>
                            </td>
                            <td class="py-3 px-6">{{ $cotizacion->updated_at }}</td>
                            <td class="py-3 px-6">
                                <a href="{{ route('generarCotizacion', $cotizacion->id) }}" target="_blank" ><x-jet-button>{{ __('Generar PDF') }}</x-jet-button></a>
                                @if ($cotizacion->cot_estado == 'Emitida')
                                    <x-jet-secondary-button wire:click="$emit('editarEstadoCotizacion', {{ $cotizacion }})">{{ __('Actualizar estado') }}</x-jet-secondary-button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($cotizaciones->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $cotizaciones->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_cot }}"
                </div>
                @endif
            </div>
        </div>
    </div>
    @livewire('cotizaciones.modal-estados')
</div>
