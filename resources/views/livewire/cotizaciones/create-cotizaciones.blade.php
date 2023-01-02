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
                                <select name="selectCliente" id="selectCliente" class="select2 block mt-1 w-full">
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->cli_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-jet-button wire:click="$emit('crearCliente')" class="my-6">{{ __('Añadir nuevo
                                    cliente') }}</x-jet-button>
                                @livewire('clientes.create-clientes')
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
                            @if ($select_id)
                                <div class="col-span-2">
                                    <table class="w-full text-base text-left">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="py-2 px-6">
                                                    Producto
                                                </th>
                                                <th scope="col" class="py-2 px-6">
                                                    Cantidad
                                                </th>
                                                <th scope="col" class="py-2 px-6">
                                                    Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cotizacionItems as $index => $cotizacionItem)
                                            <tr>
                                                <td class="py-3 px-6">
                                                    @if ($cotizacionItem['is_saved'])
                                                    <input type="hidden" name="cotizacionItems[{{ $index }}][item_id]"
                                                        wire:model="cotizacionItems.{{ $index }}.item_id">
                                                    @if ($cotizacionItem['item_nombre'] && $cotizacionItem['item_precio'])
                                                    {{ $cotizacionItem['item_nombre'] }} (${{ $cotizacionItem['item_precio'] }})
                                                    @endif
                                                    @else
                                                    <div wire:ignore>
                                                        <select name="cotizacionItems[{{ $index }}][item_id]"
                                                            class="selectItem select2"
                                                            wire:model="cotizacionItems.{{ $index }}.item_id">
                                                            <option value="">Elija un producto</option>
                                                            @foreach ($allItems as $item)
                                                            <option value="{{ $item->id }}">{{ $item->it_nombre }} (${{
                                                                $item->it_valor }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('cotizacionItems.' . $index))
                                                    <x-jet-input-error for="cotizacionItems[{{ $index }}][item_id]"
                                                        class="mt-2" />
                                                    @endif
                                                    @endif
                                                </td>
                                                <td class="py-3 px-6">
                                                    @if ($cotizacionItem['is_saved'])
                                                    <input type="hidden" name="cotizacionItems[{{ $index }}][cantidad]"
                                                        wire:model="cotizacionItems.{{ $index }}.cantidad">
                                                    {{ $cotizacionItem['cantidad'] }}
                                                    @else
                                                    <x-jet-input type="number" name="cotizacionItems[{{ $index }}][cantidad]"
                                                        class="" wire:model="cotizacionItems.{{ $index }}.cantidad" />
                                                    @endif
                                                </td>
                                                <td class="py-3 px-6">
                                                    @if ($cotizacionItem['is_saved'])
                                                    <x-jet-secondary-button class="m-1"
                                                        wire:click.prevent="editProduct({{ $index }})">Editar
                                                    </x-jet-secondary-button>
                                                    @elseif($this->item_id2)
                                                    <x-jet-button class="m-1" wire:click.prevent="saveProduct({{ $index }})">
                                                        Guardar</x-jet-button>
                                                    @endif
                                                    <x-jet-danger-button class="m-1"
                                                        wire:click.prevent="removeProduct({{ $index }})">Eliminar
                                                    </x-jet-danger-button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <x-jet-button class="m-1" wire:click.prevent="addProduct">Añadir</x-jet-button>
                                </div>
                                <div class="col-span-1">
                                    <input type="hidden" class="w-full">
                                </div>
                                <div class="col-span-1">
                                    <input type="hidden" class="w-full">
                                </div>
                                <div class="col-span-1">
                                    <div>
                                        <div class="lg:grid grid-cols-2">
                                            <x-jet-label for="subtotal" value="{{ __('Subtotal') }}" class="text-lg ml-2 my-3 col-span-1"/>
                                            <x-jet-input type="text" name="subtotal" wire:model="subtotal" class="my-1 col-span-1" disabled/>
                                        </div>
                                        <div class="lg:grid grid-cols-2">
                                            <x-jet-label for="iva" value="{{ __('IVA (19%)') }}"  class="text-lg ml-2 my-3 col-span-1"/>
                                            <x-jet-input type="text" name="iva" wire:model="iva" class="my-1 col-span-1" disabled/>
                                        </div>
                                        <div class="lg:grid grid-cols-2">
                                            <x-jet-label for="total" value="{{ __('Total') }}"  class="text-lg ml-2 my-3 col-span-1"/>
                                            <x-jet-input type="text" name="total" wire:model="total" class="my-1 col-span-1" disabled/>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="my-5">
                            @if ($subtotal!=0)
                                <x-jet-button class="m-1" wire:click.prevent='submitCotizacion'>Crear cotizacion</x-jet-button>
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
        $('.selectItem').select2({
            placeholder: 'Seleccione un item',
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
            $('.selectItem').select2({
            placeholder: 'Seleccione un item',
            "language": {
                "noResults": function(){
                    return "No hay coincidencias"
                }
            }
        }).on("select2:select", function(e) {
            @this.set('item_id2', $(this).val());
        });
        });
    });
</script>
@endsection
