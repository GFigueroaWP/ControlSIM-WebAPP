<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Detalles de Orden de trabajo') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="infoCliente">
                <x-slot name="title">
                    {{ __('Cliente y cotización') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('Identificador de cotización asociada a la orden de trabajo y su respectivo cliente') }}
                </x-slot>
                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_cot" value="{{ __('Cotización') }}" />
                        <x-jet-input id="show_cot" wire:model='show_cot' type="text"
                            placeholder="Cotización" class="mt-1 block w-full disabled" disabled/>
                        <x-jet-input-error for="show_cot" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_cliente" value="{{ __('Cliente') }}" />
                        <x-jet-input id="show_cliente" wire:model='show_cliente' type="text" class="mt-1 block w-full disabled"
                            disabled />
                        <x-jet-input-error for="show_cliente" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="show_direccion" value="{{ __('Dirección') }}" />
                        <x-jet-input id="show_direccion" wire:model='show_direccion' type="text" placeholder='Calle 123, comuna, ciudad'
                            class="mt-1 block w-full disabled" disabled />
                        <x-jet-input-error for="show_direccion" class="mt-2" />
                    </div>
                </x-slot>
            </x-jet-form-section>

            <x-jet-section-border />

            <x-jet-form-section submit="updateTareas">
                <x-slot name="title">
                    {{ __('Tareas') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Tareas asignadas a la orden de trabajo') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-base font-medium text-gray-700">Progreso</span>
                            <span class="text-sm font-medium text-csim">{{ $this->progresoTareas.'%' }}</span>
                        </div>
                        <div class="w-full bg-gray-400 rounded-full h-2.5">
                            <div class="bg-csim h-2.5 rounded-full" style="width: {{ $this->progresoTareas.'%' }}"></div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <div>
                            <table class="w-full text-base text-left">
                                <thead>
                                    <th>
                                        Tarea
                                    </th>
                                    <th>
                                        Detalle
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($this->trabajo->tareas as $tarea)
                                    <tr class="bg-white border-b hover:bg-gray-300">
                                        <td class="py-3 px-6">
                                            {{ $tarea->tar_descripcion }}
                                        </td>
                                        @if ($tarea->tar_estado == false)
                                            <td class="py-3 px-6">
                                                <x-jet-secondary-button wire:click.prevent="completarTarea({{ $tarea }})" wire:loading.attr="disabled">
                                                    {{ __('completar') }}
                                                </x-jet-secondary-button>
                                            </td>
                                        @else
                                            <td class="py-3 px-6">
                                                Completada el {{ $tarea->tar_completada }}
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-slot>
            </x-jet-form-section>


            <x-jet-section-border />

            <x-jet-form-section submit="subirInforme">
                <x-slot name="title">
                    {{ __('Informes') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Informes de conclusion del proyecto') }}
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="file_input" value={{ __('Adjuntar informe') }} />
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" aria-describedby="file_input_help" id="file_input" type="file" wire:model='informe' />
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help">Solo archivos PDF</p>
                        <x-jet-button type="submit" wire:click.prevent="subirInforme">{{ __('subir informe') }}</x-jet-button>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <div>
                            <table class="w-full text-base text-left">
                                <thead>
                                    <th>
                                        Informe
                                    </th>
                                    <th>
                                        Subido
                                    </th>
                                    <th>
                                        Acciones
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($this->trabajo->informes as $informe)
                                    <tr class="bg-white border-b hover:bg-gray-300">
                                        <td class="py-3 px-6">
                                            {{ $informe->inf_directorio }}
                                        </td>
                                        <td class="py-3 px-6">
                                            Subido el {{ $informe->created_at }}
                                        </td>
                                        <td>
                                            <x-jet-button wire:click.prevent='descargarInforme({{ $informe }})'>Descargar</x-jet-button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </x-slot>
            </x-jet-form-section>
        </div>
    </div>
</div>
