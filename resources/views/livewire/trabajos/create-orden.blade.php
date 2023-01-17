{{-- <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear nueva orden de trabajo') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="relative shadow-md sm:rounded-lg p-5">
                    <form wire:submit.prevent='submitOrden' class="space-y-4">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div class="col-span-2">
                                <h1 class="text-lg font-bold">Datos del cliente</h1>
                            </div>
                            <div>
                                <x-jet-label for="razon_cli" value="{{ __('Razon social') }}" />
                                <x-jet-input type="text" name="razon_cli" id="razon_cli" wire:model="razon_cli"
                                    class="mt-1 block w-full disabled" disabled></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="giro_cli" value="{{ __('Giro') }}" />
                                <x-jet-input type="text" name="giro_cli" id="giro_cli" wire:model="giro_cli"
                                    class="mt-1 block w-full disabled" disabled></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="rut_cli" value="{{ __('Rut') }}" />
                                <x-jet-input type="text" name="rut_cli" id="rut_cli" wire:model="rut_cli"
                                    class="mt-1 block w-full disabled" disabled></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="direccion_cli" value="{{ __('Direccion') }}" />
                                <x-jet-input type="text" name="direccion_cli" id="direccion_cli"
                                    wire:model="direccion_cli" class="mt-1 block w-full disabled" disabled></x-jet-input>
                            </div>
                            <div class="col-span-2">
                                <x-jet-section-border />
                            </div>
                            <div class="col-span-2">
                                <h1 class="text-lg font-bold">Cotización asociada</h1>
                            </div>
                            <div class="col-span-1 grid grid-cols-2">
                                <div class="col-span-1">
                                    <x-jet-label for="cotizacion_id" value="{{ __('Cotizacion_id') }}" />
                                    <x-jet-input type="text" name="cotizacion_id" id="cotizacion_id"
                                    wire:model="cotizacion_id" class="mt-1 block w-full disabled" disabled></x-jet-input>
                                </div>
                                <div wire:ignore class="col-span-1 mt-7 mx-1">
                                    <a href="{{ route('generarCotizacion', $this->cotizacion->id) }}" target="_blank" ><x-jet-button>{{ __('Generar PDF') }}</x-jet-button></a>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <x-jet-section-border />
                            </div>
                            <div class="col-span-2">
                                <h1 class="text-lg font-bold">Técnicos</h1>
                            </div>
                            <div class="col-span-2">
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
                                                    wire:click.prevent="editTecnico({{ $index }})">Editar
                                                </x-jet-secondary-button>
                                                @elseif($this->tecnico_id2)
                                                <x-jet-button class="m-1"
                                                    wire:click.prevent="saveTecnico({{ $index }})">
                                                    Guardar</x-jet-button>
                                                @endif
                                                <x-jet-danger-button class="m-1"
                                                    wire:click.prevent="removeTecnico({{ $index }})">Eliminar
                                                </x-jet-danger-button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <x-jet-button class="m-1" wire:click.prevent="addTecnico">Añadir tecnico</x-jet-button>
                            </div>
                            @if ($tecnicosSeleccionados)
                                <div class="col-span-2">
                                    <x-jet-section-border />
                                </div>
                                <div class="col-span-2">
                                    <h1 class="text-lg font-bold">Tareas</h1>
                                </div>
                                <div class="col-span-2">
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
                                                        wire:click.prevent="editTarea({{ $index }})">Editar
                                                    </x-jet-secondary-button>
                                                    @else
                                                    <x-jet-button class="m-1"
                                                        wire:click.prevent="saveTarea({{ $index }})">
                                                        Guardar</x-jet-button>
                                                    @endif
                                                    <x-jet-danger-button class="m-1"
                                                        wire:click.prevent="removeTarea({{ $index }})">Eliminar
                                                    </x-jet-danger-button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <x-jet-button class="m-1" wire:click.prevent="addTarea">Añadir Tarea</x-jet-button>
                                </div>
                                @if ($tareasAgregadas)
                                    <div class="col-span-2">
                                        <x-jet-section-border />
                                    </div>
                                    <div class="col-span-2">
                                        <h1 class="text-lg font-bold">Fechas de inicio y limite</h1>
                                    </div>
                                    <div class="col-span-1">
                                        <x-jet-label />
                                        <x-jet-input type="date" min="{{ $this->fechaActual }}" wire:model='fechaInicio'/>
                                    </div>
                                    <div class="col-span-1">
                                        <x-jet-label />
                                        <x-jet-input type="date" min="{{ $this->fechaInicio }}" wire:model='fechaLimite'/>
                                    </div>
                                @endif
                                @if ($fechaLimite)
                                    <x-jet-button wire:click.prevent="submitOrden">{{ __('Crear Orden') }}</x-jet-button>
                                @endif
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
                    <div class="col-span-4 sm:col-span-2">
                        <x-jet-label for="cotizacion_id" value="{{ __('Cotización') }}" />
                        <x-jet-input id="cotizacion_id" wire:model='cotizacion_id' type="text"
                            placeholder="Cotización" class="mt-1 block w-full disabled" disabled/>
                        <x-jet-input-error for="cotizacion_id" class="mt-2" />
                    </div>
                    <div class="col-span-2 sm:col-span-2 pt-7">
                        <a href="{{ route('generarCotizacion', $this->cotizacion_id) }}" target="_blank" ><x-jet-button>{{ __('Generar PDF') }}</x-jet-button></a>
                    </div>
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
                        <x-jet-button class="m-1" wire:click.prevent="addTecnico">Añadir tecnico</x-jet-button>
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
                                            wire:click.prevent="editTecnico({{ $index }})">Editar
                                        </x-jet-secondary-button>
                                        @elseif($this->tecnico_id2)
                                        <x-jet-button class="m-1"
                                            wire:click.prevent="saveTecnico({{ $index }})">
                                            Guardar</x-jet-button>
                                        @endif
                                        <x-jet-danger-button class="m-1"
                                            wire:click.prevent="removeTecnico({{ $index }})">Eliminar
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
                                                wire:click.prevent="editTarea({{ $index }})">Editar
                                            </x-jet-secondary-button>
                                            @else
                                            <x-jet-button class="m-1"
                                                wire:click.prevent="saveTarea({{ $index }})">
                                                Guardar</x-jet-button>
                                            @endif
                                            <x-jet-danger-button class="m-1"
                                                wire:click.prevent="removeTarea({{ $index }})">Eliminar
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
                                <x-jet-button class="m-1" wire:click.prevent="addTarea">Añadir Tarea</x-jet-button>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="fechaInicio" value="{{ __('Fecha de inicio estimada') }}"/>
                                <x-jet-input type="date" min="{{ $this->fechaActual }}" wire:model='fechaInicio'/>
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="fechaLimite" value="{{ __('Fecha de termino estimada') }}"/>
                                <x-jet-input type="date" min="{{ $this->fechaInicio }}" wire:model='fechaLimite'/>
                            </div>
                        </x-slot>
                        @if ($fechaLimite)
                            <x-slot name="actions">
                                <x-jet-button wire:click.prevent="submitOrden">{{ __('Crear Orden') }}</x-jet-button>
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

