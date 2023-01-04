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
                    @if ($this->progresoCotizacion == 'Emitida')
                        <li class="flex items-center justify-center text-blue-600">
                            <span class="h-6 w-6 rounded bg-blue-50 text-center text-[10px] font-bold leading-6">
                                2
                            </span>
                            <span class="ml-2">Esperando Respuesta</span>
                        </li>
                    @elseif ($this->progresoCotizacion == 'Aceptada')
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
                    @elseif ($this->progresoCotizacion == 'Rechazada')
                        <li class="flex items-center justify-center">
                            <span class="rounded bg-red-50 p-1.5 text-red-600">
                                X
                            </span>
                            <span class="ml-2 text-red-600">Cotizacion Rechazada</span>
                        </li>
                    @endif
                    <li class="flex items-center justify-end">
                        <span class="h-6 w-6 rounded bg-gray-50 text-center text-[10px] font-bold leading-6 text-gray-600">
                        3
                        </span>
                        <span class="ml-2"> Generar orden de trabajo </span>
                    </li>
                    <li class="flex items-center justify-end">
                        <span class="h-6 w-6 rounded bg-gray-50 text-center text-[10px] font-bold leading-6 text-gray-600">
                        4
                        </span>
                        <span class="ml-2"> Estado de orden de trabajo </span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="overflow-x-auto border border-gray-200 m-5">
            <table class="min-w-full divide-y-2 divide-gray-200 text-sm">
                <thead>
                    <tr>
                        <th>
                            Cotizacion
                        </th>
                        <th>
                            Cliente
                        </th>
                        <th>
                            Emitida
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Fecha Actualizada
                        </th>
                        <th>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
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
                        @if ($this->progresoCotizacion != 'Emitida')
                            <td>
                                fecha actualizada
                            </td>
                        @else
                            <td>
                                No ha sido actualizada
                            </td>
                        @endif
                        <td>
                            <a href="{{ route('generarCotizacion', $this->cotizacion_id) }}"><x-jet-button>Generar</x-jet-button></a>
                            @if ($this->progresoCotizacion == 'Emitida')
                            <x-jet-secondary-button wire:click="$emit('editarEstadoCotizacion', {{ $this->cotizacion_id }})">{{ __('Actualizar estado') }}</x-jet-secondary-button>
                            @elseif ($this->progresoCotizacion == 'Rechazada')
                                <x-jet-danger-button>Eliminar</x-jet-danger-button>
                            @endif
                        </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($this->progresoCotizacion == 'Aceptada')
            @if ($this->progresoCotizacion == 'Aceptada')
                <x-jet-button>Nueva Orden de trabajo</x-jet-button>
            @else
                <div>
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
                </div>
            @endif
        @endif
    </x-slot>

    <x-slot name="footer">
        b
    </x-slot>
</x-jet-dialog-modal>
