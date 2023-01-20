<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Proyectos') }}
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
                </div>
                <div class="m-5">
                    <livewire:proyectos.proyecto-table />
                </div>
                {{-- <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                Cotizacion
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Estado Cotización
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Orden de trabajo
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Estado Orden de trabajo
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
                                <td class="py-3 px-6">
                                    <strong class="{{ $cotizacion->cot_estado }}">
                                        {{ $cotizacion->cot_estado }}
                                    </strong>
                                </td>
                            @if ($cotizacion->trabajo)
                                <td class="py-3 px-6">{{ 'OT-'.str_pad($cotizacion->trabajo->id,5,'0',STR_PAD_LEFT) }}</td>
                                <td class="py-3 px-6">
                                    <strong class="{{ $cotizacion->trabajo->ot_estado }}">
                                        {{ $cotizacion->trabajo->ot_estado }}
                                    </strong>
                                </td>
                            @else
                                <td class="py-3 px-6">No hay orden asociada</td>
                                <td></td>
                            @endif
                            <td class="py-3 px-6">
                                <x-jet-button wire:click="$emit('showProgreso',{{ $cotizacion }},{{ $cotizacion->trabajo }})">Ver</x-jet-button>
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
                    No hay resultados para la búsqueda "{{ $filtro_pr }}"
                </div>
                @endif --}}
            </div>
        </div>
    </div>

    @livewire('proyectos.modal-progreso')
    @livewire('cotizaciones.modal-estados')
</div>
