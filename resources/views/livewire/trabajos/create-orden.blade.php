<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear Cotización') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="infoCliente">
                <x-slot name="title">
                    {{ __('Información de cotizacion y cliente') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('Información sobre la cotizacion asociada y su respectivo cliente') }}
                </x-slot>
                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cotizacion_id" value="{{ __('Cotización') }}" />
                        <x-jet-input id="cotizacion_id" wire:model='cotizacion_id' type="text"
                            placeholder="Cotización" class="mt-1 block w-full disabled" disabled/>
                        <x-jet-input-error for="cotizacion_id" class="mt-2" />
                    </div>
                    {{-- <div class="col-span-2 sm:col-span-2 pt-7">
                        <a href="{{ route('generarCotizacion', $this->cotizacion_id) }}" target="_blank" ><x-jet-button>{{ __('Generar PDF') }}</x-jet-button></a>
                    </div> --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="razon_cli" value="{{ __('Cliente') }}" />
                        <x-jet-input id="razon_cli" wire:model='razon_cli' type="text" class="mt-1 block w-full disabled"
                            disabled />
                        <x-jet-input-error for="razon_cli" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="giro_cli" value="{{ __('Giro') }}" />
                        <x-jet-input id="giro_cli" wire:model='giro_cli' type="text" class="mt-1 block w-full disabled"
                            disabled />
                        <x-jet-input-error for="giro_cli" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="direccion_cli" value="{{ __('Dirección') }}" />
                        <x-jet-input id="direccion_cli" wire:model='direccion_cli' type="text" placeholder='Calle 123, comuna, ciudad'
                            class="mt-1 block w-full disabled" disabled />
                        <x-jet-input-error for="direccion_cli" class="mt-2" />
                    </div>
                </x-slot>
            </x-jet-form-section>

            <x-jet-section-border />

            <x-jet-form-section submit="listadoTecnicos">
                <x-slot name="title">
                    {{ __('Asignación de tecnicos') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('Listado de tecnicos asignados al proyecto') }}
                </x-slot>
                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-button class="m-1" wire:click.prevent="addTecnico" wire:loading.attr="disabled" >Añadir tecnico</x-jet-button>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <table class="w-full text-base text-left">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-2 px-6">
                                        Técnico
                                    </th>
                                    <th scope="col" class="py-2 px-6">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tecnicosSeleccionados as $index => $tecnicoSeleccionado)
                                <tr>
                                    <td class="py-3 px-6">
                                        @if ($tecnicoSeleccionado['is_saved'])
                                            <input type="hidden" name="tecnicosSeleccionados[{{ $index }}][tecnico_id]"
                                            wire:model="tecnicosSeleccionados.{{ $index }}.tecnico_id">
                                            @if ($tecnicoSeleccionado['tecnico_nombre'] && $tecnicoSeleccionado['tecnico_apellido'])
                                                {{ $tecnicoSeleccionado['tecnico_nombre'] }} {{ $tecnicoSeleccionado['tecnico_apellido'] }}
                                            @endif
                                        @else
                                            <div wire:ignore>
                                                <select name="tecnicosSeleccionados[{{ $index }}][tecnico_id]"
                                                    class="selectTecnico select2 w-full"
                                                    wire:model="tecnicosSeleccionados.{{ $index }}.tecnico_id">
                                                    <option value="">Elija un producto</option>
                                                    @foreach ($tecnicos as $tecnico)
                                                    <option value="{{ $tecnico->id }}">{{ $tecnico->us_nombre }} {{
                                                        $tecnico->us_apellido }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('tecnicosSeleccionados'.$index.'tecnico_id'))
                                                <em class="text-red-600 text-sm">
                                                    {{ $errors->first('tecnicosSeleccionados'.$index.'tecnico_id') }}
                                                </em>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        @if ($tecnicoSeleccionado['is_saved'])
                                        <x-jet-secondary-button class="m-1"
                                            wire:click.prevent="editTecnico({{ $index }})" wire:loading.attr="disabled" >Editar
                                        </x-jet-secondary-button>
                                        @elseif($this->tecnico_id2)
                                        <x-jet-button class="m-1"
                                            wire:click.prevent="saveTecnico({{ $index }})" wire:loading.attr="disabled" >
                                            Guardar</x-jet-button>
                                        @endif
                                        <x-jet-danger-button class="m-1"
                                            wire:click.prevent="removeTecnico({{ $index }})" wire:loading.attr="disabled" >Eliminar
                                        </x-jet-danger-button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-slot>
            </x-jet-form-section>

            @if ($tecnicosSeleccionados)
                <x-jet-section-border />

                <x-jet-form-section submit="listadoTareas">
                    <x-slot name="title">
                        {{ __('Tareas') }}
                    </x-slot>
                    <x-slot name="description">
                        {{ __('Listado de tareas a realizar') }}
                    </x-slot>
                    <x-slot name="form">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-button class="m-1" wire:click.prevent="addTarea">Añadir Tarea</x-jet-button>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <table class="w-full text-base text-left">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-2 px-6">
                                            Tarea
                                        </th>
                                        <th scope="col" class="py-2 px-6">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tareasAgregadas as $index => $tareaAgregada)
                                    <tr>
                                        <td class="py-3 px-6">
                                            @if ($tareaAgregada['is_saved'])
                                                <input type="hidden" name="tareasAgregadas[{{ $index }}][tarea]"
                                                wire:model="tareasAgregadas.{{ $index }}.tarea">
                                                @if ($tareaAgregada['tarea'])
                                                    {{ $tareaAgregada['tarea'] }}
                                                @endif
                                            @else
                                                <x-jet-input type="text" wire:model="tareasAgregadas.{{ $index }}.tarea"></x-jet-input>
                                                @if ($errors->has('tareasAgregadas'.$index.'tarea'))
                                                    <em class="text-red-600 text-sm">
                                                        {{ $errors->first('tareasAgregadas'.$index.'tarea') }}
                                                    </em>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="py-3 px-6">
                                            @if ($tareaAgregada['is_saved'])
                                            <x-jet-secondary-button class="m-1"
                                                wire:click.prevent="editTarea({{ $index }})" wire:loading.attr="disabled" >Editar
                                            </x-jet-secondary-button>
                                            @else
                                            <x-jet-button class="m-1"
                                                wire:click.prevent="saveTarea({{ $index }})" wire:loading.attr="disabled" >
                                                Guardar</x-jet-button>
                                            @endif
                                            <x-jet-danger-button class="m-1"
                                                wire:click.prevent="removeTarea({{ $index }})" wire:loading.attr="disabled" >Eliminar
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </x-slot>
                </x-jet-form-section>
                @if ($tareasAgregadas)
                    <x-jet-section-border />

                    <x-jet-form-section submit="listadoTareas">
                        <x-slot name="title">
                            {{ __('Fechas estimadas') }}
                        </x-slot>
                        <x-slot name="description">
                            {{ __('Fechas de inicio y termino estimadas para el proyecto') }}
                        </x-slot>
                        <x-slot name="form">
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="fechaInicio" value="{{ __('Fecha de inicio estimada') }}"/>
                                <x-jet-input type="date" min="{{ $this->fechaActual }}" wire:model='fechaInicio'/>
                            </div>
                            @if ($this->fechaInicio)
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="fechaLimite" value="{{ __('Fecha de termino estimada') }}"/>
                                    <x-jet-input type="date" min="{{ $this->fechaInicio }}" wire:model='fechaLimite'/>
                                </div>
                            @else
                                <div class="col-span-6 sm:col-span-4">
                                    <x-jet-label for="fechaLimite" value="{{ __('Fecha de termino estimada') }}"/>
                                    <x-jet-input class="disabled" type="date" min="{{ $this->fechaInicio }}" wire:model='fechaLimite' disabled/>
                                </div>
                            @endif
                        </x-slot>
                        @if ($fechaLimite)
                            <x-slot name="actions">
                                <x-jet-button wire:click.prevent="submitOrden" wire:loading.attr="disabled" >{{ __('Crear Orden') }}</x-jet-button>
                            </x-slot>
                        @endif
                    </x-jet-form-section>
                @endif
            @endif

        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('.selectTecnico').select2({
            placeholder: 'Seleccione un tecnico',
            "language": {
                "noResults": function(){
                    return "No hay coincidencias"
                }
            }
        });
        $('#selectCliente').select2({
            placeholder: 'Seleccione un cliente',
            "language": {
                "noResults": function(){
                    return "No hay coincidencias"
                }
            }
        });
        $('#selectCliente').on('change', function(e) {
            @this.set('select_id', $(this).val())
            @this.fillCliente()
        });
        window.addEventListener('reApplySelect2', event => {
            $('.selectTecnico').select2({
            placeholder: 'Seleccione un tecnico',
            "language": {
                "noResults": function(){
                    return "No hay coincidencias"
                }
            }
        }).on("select2:select", function(e) {
            @this.set('tecnico_id2', $(this).val());
        });
        });
    });
</script>
@endsection

