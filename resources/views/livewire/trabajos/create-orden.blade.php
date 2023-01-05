<x-slot name="header">
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
                                    class="mt-1 block w-full" disabled></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="giro_cli" value="{{ __('Giro') }}" />
                                <x-jet-input type="text" name="giro_cli" id="giro_cli" wire:model="giro_cli"
                                    class="mt-1 block w-full" disabled></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="rut_cli" value="{{ __('Rut') }}" />
                                <x-jet-input type="text" name="rut_cli" id="rut_cli" wire:model="rut_cli"
                                    class="mt-1 block w-full" disabled></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="direccion_cli" value="{{ __('Direccion') }}" />
                                <x-jet-input type="text" name="direccion_cli" id="direccion_cli"
                                    wire:model="direccion_cli" class="mt-1 block w-full" disabled></x-jet-input>
                            </div>
                            <div class="col-span-2">
                                <table class="w-full text-base text-left">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-2 px-6">
                                                Tecnico
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
                                                            class="selectTecnico select2"
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
                            @if ($toggleTareas)
                            <div class="col-span-2">
                                {{-- <table class="w-full text-base text-left">
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
                                                    <x-jet-input></x-jet-input>
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
                                </table> --}}
                            </div>
                            <div>
                                <x-jet-button class="m-1" wire:click.prevent="addTarea">Añadir Tarea</x-jet-button>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
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

