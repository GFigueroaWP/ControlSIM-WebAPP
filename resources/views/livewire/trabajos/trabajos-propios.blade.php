<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Trabajos Asignados') }}
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
                    <label for="search_trabajos" class="sr-only">Buscar</label>
                    <div class="relative justify-self-end">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model='filtro_tr' class="block p-2 pl-10 w-80 border border-gray-300" type="text"
                            name="search_trabajos" id="search_trabajos" placeholder="Buscar trabajos">
                    </div>
                </div>
                <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                Orden
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Fecha de inicio
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Fecha limite
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Estado
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Fecha completada
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trabajos as $trabajo)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ $trabajo->id }}</td>
                            <td class="py-3 px-6">{{ $trabajo->ot_inicio}}</td>
                            <td class="py-3 px-6">{{ $trabajo->ot_limite }}</td>
                            <td class="py-3 px-6">
                                <strong class="{{ $trabajo->ot_estado }}">
                                    {{ $trabajo->ot_estado }}
                                </strong></td>
                            <td class="py-3 px-6">{{ $trabajo->ot_completada }}</td>
                            <td class="py-3 px-6">
                                <a href="{{ route('showTrabajos', $trabajo->id) }}"><x-jet-button>{{ __('Ver') }}</x-jet-button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($trabajos->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $trabajos->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_tr }}"
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
