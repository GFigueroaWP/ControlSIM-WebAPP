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
                    <label for="search_proyecto" class="sr-only">Buscar</label>
                    <div class="relative justify-self-end">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model='filtro_pr' class="block p-2 pl-10 w-80 border border-gray-300" type="text"
                            name="search_proyecto" id="search_items" placeholder="Buscar proyecto">
                    </div>
                </div>
                <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Cotizacion
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Orden de trabajo
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $proyecto)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ $proyecto->id }}</td>
                            @if ($proyecto->cotizacion)
                                <td class="py-3 px-6">{{ $proyecto->cotizacion->id }}</td>
                            @else
                                <td class="py-3 px-6">No hay cotizacion asociada</td>
                            @endif
                            @if ($proyecto->orden)
                                <td class="py-3 px-6">{{ $proyecto->cotizacion->id }}</td>
                            @else
                                <td class="py-3 px-6">No hay orden asociada</td>
                            @endif
                            <td class="py-3 px-6">
                                <x-jet-button wire:click='showProgreso({{ $proyecto }})'>Ver</x-jet-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($proyectos->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $proyectos->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_pr }}"
                </div>
                @endif
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model='modalShowProyecto'>
        <x-slot name="title">
            {{ _('Informacion del proyecto') }}
        </x-slot>

        <x-slot name="content">
            {{-- Barra de progreso --}}
            <div class="flex justify-center">
                <h2 class="sr-only">Progreso</h2>
                <div class="">
                    <ol class="flex items-center gap-2 text-xs font-medium text-gray-500 sm:gap-4">
                        <li class="flex items-center justify-center">
                            <span class="rounded bg-green-50 p-1.5 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            <span class="ml-2 text-green-600">Cotizacion Emitida </span>
                        </li>
                        @if ($this->proyectoSeleccionado->cotizacion->cot_estado ?? '' == 'Emitida')
                            <li class="flex items-center justify-center text-blue-600">
                                <span class="h-6 w-6 rounded bg-blue-50 text-center text-[10px] font-bold leading-6">
                                    2
                                </span>
                                <span class="ml-2">Esperando Respuesta</span>
                            </li>
                        @elseif (($this->proyectoSeleccionado->cotizacion->cot_estado ?? '' == 'Aceptada'))
                            <li class="flex items-center justify-center">
                                <span class="rounded bg-green-50 p-1.5 text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                        />
                                    </svg>
                                </span>
                                <span class="ml-2 text-green-600">Cotizacion Aceptada</span>
                            </li>
                        @elseif (($this->proyectoSeleccionado->cotizacion->cot_estado ?? '' == 'Rechazada'))
                            <li class="flex items-center justify-center">
                                <span class="rounded bg-red-50 p-1.5 text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                        />
                                    </svg>
                                </span>
                                <span class="ml-2 text-green-600">Cotizacion Rechazada</span>
                            </li>
                        @endif
                        <li class="flex items-center justify-end">
                            <span class="h-6 w-6 rounded bg-gray-50 text-center text-[10px] font-bold leading-6 text-gray-600">
                            3
                            </span>
                            <span class="ml-2"> Payment </span>
                        </li>
                    </ol>
                </div>
            </div>

            <table>
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $this->proyectoSeleccionado->cotizacion->id ?? '' }}
                        </td>
                        <td>
                            {{ $this->proyectoSeleccionado->cotizacion->cliente->cli_razonsocial ?? '' }}
                        </td>
                        <td>
                            {{ $this->proyectoSeleccionado->cotizacion->created_at ?? '' }}
                        </td>
                        <td>
                            {{ $this->proyectoSeleccionado->cotizacion->cot_estado ?? '' }}
                        </td>
                        @if ($this->proyectoSeleccionado->cotizacion->cot_estado ?? '' != 'Emitida')
                            <td>
                                fecha actualizada
                            </td>
                        @else
                            <td>
                                No ha sido actualizada
                            </td>
                        @endif
                        <td>
                            Generar
                            Actualizar
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            Orden
                        </td>
                        <td>
                            Estado
                        </td>
                        <td>
                            FEcha inicio
                        </td>
                        <td>
                            Fecha limite
                        </td>
                        <td>
                            Fecha completada
                        </td>
                        <td>
                            Generar
                            Actualizar
                        </td>
                    </tr>
                </tbody>
            </table>

        </x-slot>

        <x-slot name="footer">
            b
        </x-slot>
    </x-jet-dialog-modal>
</div>
