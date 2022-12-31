<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Crear nueva cotizacion') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="relative shadow-md sm:rounded-lg p-5">
                    <form wire:submit.prevent='submitCotizacion' class="space-y-4">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div wire:ignore>
                                <x-jet-label for="selectCliente" value="{{ __('Seleccione Cliente') }}" />
                                <select name="selectCliente" id="selectCliente" class="select2">
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->cli_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-button wire:click="$emit('crearCliente')" class="my-6">{{ __('Añadir nuevo cliente') }}</x-jet-button>
                                @livewire('clientes.create-clientes')
                            </div>
                            <div>
                                <x-jet-label for="razon_cli" value="{{ __('Razon social') }}" />
                                <x-jet-input type="text" name="razon_cli" id="razon_cli" wire:model="razon_cli" class="mt-1 block w-full"></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="giro_cli" value="{{ __('Giro') }}" />
                                <x-jet-input type="text" name="giro_cli" id="giro_cli" wire:model="giro_cli" class="mt-1 block w-full"></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="rut_cli" value="{{ __('Rut') }}" />
                                <x-jet-input type="text" name="rut_cli" id="rut_cli" wire:model="rut_cli" class="mt-1 block w-full"></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label for="direccion_cli" value="{{ __('Direccion') }}" />
                                <x-jet-input type="text" name="direccion_cli" id="direccion_cli" wire:model="direccion_cli" class="mt-1 block w-full" ></x-jet-input>
                            </div>
                        </div>
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                Producto
                                            </th>
                                            <th>
                                                Cantidad
                                            </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cotizacionItems as $index => $cotizacionItem)
                                            <tr>
                                                <td>
                                                    @if ($cotizacionItem['is_saved'])
                                                        <input type="hidden" name="cotizacionItems[{{ $index }}][item_id]" wire:model="cotizacionItems.{{ $index }}.item_id">
                                                        @if ($cotizacionItem['item_nombre'] && $cotizacionItem['item_precio'])
                                                            {{ $cotizacionItem['item_nombre']  }} (${{ $cotizacionItem['item_precio'] }})
                                                        @endif
                                                    @else
                                                        <div wire:ignore>
                                                            <select name="cotizacionItems[{{ $index }}][item_id]" class="selectItem"  wire:model="cotizacionItems.{{ $index }}.item_id">
                                                                <option value="">Elija un producto</option>
                                                                @foreach ($allItems as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->it_nombre }} (${{ $item->it_valor }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @if ($errors->has('cotizacionItems.' . $index))
                                                            <x-jet-input-error for="cotizacionItems[{{ $index }}][item_id]" class="mt-2" />
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cotizacionItem['is_saved'])
                                                        <input type="hidden" name="cotizacionItems[{{ $index }}][cantidad]" wire:model="cotizacionItems.{{ $index }}.cantidad">
                                                            {{ $cotizacionItem['cantidad']  }}
                                                    @else
                                                        <input type="number" name="cotizacionItems[{{ $index }}][cantidad]" class="" wire:model="cotizacionItems.{{ $index }}.cantidad">
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cotizacionItem['is_saved'])
                                                        <x-jet-secondary-button class="" wire:click.prevent="editProduct({{ $index }})">Editar</x-jet-secondary-button>
                                                    @elseif($this->item_id2)
                                                        <x-jet-button class="" wire:click.prevent="saveProduct({{ $index }})">Guardar</x-jet-button>
                                                    @endif
                                                        <x-jet-danger-button class="" wire:click.prevent="removeProduct({{ $index }})">Eliminar</x-jet-danger-button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    <x-jet-button class="m-1" wire:click.prevent="addProduct">Añadir</x-jet-button>
                                </div>
                            </div>
                        <x-jet-button class="m-1" wire:click.prevent='submitCotizacion'>Crear cotizacion</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('.selectItem').select2({
            placeholder: 'Seleccione un item'
        });
        $('#selectCliente').select2({
            placeholder: 'Seleccione un cliente'
        });
        $('#selectCliente').on('change', function(e) {
            @this.set('select_id', $(this).val())
            @this.fillCliente()
        });
        window.addEventListener('reApplySelect2', event => {
            $('.selectItem').select2({
            placeholder: 'Seleccione un item'
        }).on("select2:select", function(e) {
            @this.set('item_id2', $(this).val());
        });
        });
    });
</script>
@endsection
