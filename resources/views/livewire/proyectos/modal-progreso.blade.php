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
                    @if ($this->progresoTrabajo == 'no')
                        <li class="flex items-center justify-end">
                        <span class="h-6 w-6 rounded bg-gray-50 text-center text-[10px] font-bold leading-6 text-gray-600">
                        3
                        </span>
                        <span class="ml-2"> Generar orden de trabajo </span>
                        </li>
                    @elseif ($this->progresoTrabajo == 'Planificada')
                        <li class="flex items-center justify-center text-blue-600">
                            <span class="h-6 w-6 rounded bg-blue-50 text-center text-[10px] font-bold leading-6">
                                3
                            </span>
                            <span class="ml-2">Trabajo planificado</span>
                        </li>
                    @elseif ($this->progresoTrabajo == 'Iniciada' || $this->progresoTrabajo == 'Completada' || $this->progresoTrabajo == 'Cancelada')
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
                            <span class="ml-2 text-green-600">Trabajo iniciado</span>
                        </li>
                    @endif
                    @if ($this->progresoTrabajo == 'no' || $this->progresoTrabajo == 'Planificada' || $this->progresoTrabajo == 'Iniciada')
                    <li class="flex items-center justify-end">
                        <span class="h-6 w-6 rounded bg-gray-50 text-center text-[10px] font-bold leading-6 text-gray-600">
                        4
                        </span>
                        <span class="ml-2"> Estado de orden de trabajo </span>
                    </li>
                    @elseif ($this->progresoTrabajo == 'Cancelada')
                    <li class="flex items-center justify-center">
                        <span class="rounded bg-red-50 p-1.5 text-red-600">
                            X
                        </span>
                        <span class="ml-2 text-red-600">Trabajo Cancelado</span>
                    </li>
                    @elseif ($this->progresoTrabajo == 'Completada')
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
                            <span class="ml-2 text-green-600">Trabajo completado</span>
                        </li>
                    @endif
                </ol>
            </div>
        </div>
        <div class="grid sm:grid-cols-2">
            <div class="col-span-1 m-5 justify-self-center">
                <h1>{{ __('Cliente:') }}</h1>
            </div>
            <div class="col-span-1 m-5 justify-self-center">
                {{ $this->proyectoSeleccionado->cliente->cli_razonsocial ?? '' }}
            </div>
        </div>
        <div class="overflow-x-auto border border-gray-200 m-5">
            <table class="min-w-full divide-y-2 divide-gray-200 text-xs w-full text-left">
                <thead>
                    <tr>
                        <th class="py-1 px-3 text-center">
                            Cotizacion
                        </th>
                        <th class="py-1 px-3 text-center">
                            Emitida
                        </th>
                        <th class="py-1 px-3 text-center">
                            Estado
                        </th>
                        <th class="py-1 px-3 text-center">
                            Fecha Actualizada
                        </th>
                        <th class="py-1 px-3 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-1 px-3 text-center">
                            {{ 'COT-'.str_pad($this->proyectoSeleccionado->id ?? '',5,'0',STR_PAD_LEFT) }}
                        </td>
                        <td class="py-1 px-3 text-center">
                            {{ $this->proyectoSeleccionado->created_at ?? '' }}
                        </td>
                        <td class="py-1 px-3 text-center">
                            <strong class="{{ $this->proyectoSeleccionado->cot_estado ?? '' }}">
                                {{ $this->proyectoSeleccionado->cot_estado ?? '' }}
                            </strong>
                        </td>
                        @if ($this->progresoCotizacion != 'Emitida')
                            <td class="py-1 px-3 text-center">
                                {{ $this->proyectoSeleccionado->updated_at ?? '' }}
                            </td>
                        @else
                            <td class="py-1 px-3 text-center">
                                No ha sido actualizada
                            </td>
                        @endif
                        <td class="py-1 px-3 text-center">
                            <a href="{{ route('generarCotizacion', $this->cotizacion_id) }}" target="_blank" ><x-jet-button>{{ __('Generar PDF') }}</x-jet-button></a>
                            @if ($this->progresoCotizacion == 'Emitida')
                                <x-jet-secondary-button wire:click="$emit('editarEstadoCotizacion', {{ $this->cotizacion_id }})">{{ __('Actualizar estado') }}</x-jet-secondary-button>
                            @endif
                        </td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if ($this->progresoCotizacion == 'Aceptada')
            @if ($this->progresoTrabajo == 'no')
                <a href="{{ route('createOrdenes',$this->proyectoSeleccionado) }}"><x-jet-button>{{ __('Crear orden de trabajo') }}</x-jet-button></a>
            @else
                <div class="overflow-x-auto border border-gray-200 m-5">
                    <table class="min-w-full divide-y-2 divide-gray-200 text-xs w-full text-left">
                        <thead>
                            <tr>
                                <th class="py-1 px-3 text-center">
                                    Orden
                                </th>
                                <th class="py-1 px-3 text-center">
                                    Fecha Inicio
                                </th>
                                <th class="py-1 px-3 text-center">
                                    Feche Limite
                                </th>
                                <th class="py-1 px-3 text-center">
                                    Fecha cierre
                                </th>
                                <th class="py-1 px-3 text-center">
                                    Estado
                                </th>
                                <th class="py-1 px-3 text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="py-1 px-3 text-center">
                                    {{ 'OT-'.str_pad($this->proyectoSeleccionado->trabajo->id ?? '',5,'0',STR_PAD_LEFT) }}
                                </td>
                                <td class="py-1 px-3 text-center">
                                    {{ $this->proyectoSeleccionado->trabajo->ot_inicio ?? '' }}
                                </td>
                                <td class="py-1 px-3 text-center">
                                    {{ $this->proyectoSeleccionado->trabajo->ot_limite ?? '' }}
                                </td>
                                <td class="py-1 px-3 text-center">

                                </td>
                                <td class="py-1 px-3 text-center">
                                    <strong class="{{ $this->proyectoSeleccionado->trabajo->ot_estado ?? '' }}">
                                        {{ $this->proyectoSeleccionado->trabajo->ot_estado ?? '' }}
                                    </strong>
                                </td>
                                <td class="py-1 px-3 text-center">
                                    <a href="{{ route('showTrabajos', $this->proyectoSeleccionado->trabajo->id ?? '') }}"><x-jet-button>{{ __('Ver') }}</x-jet-button></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('modalShowProyecto')">{{ __('cerrar') }}</x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
