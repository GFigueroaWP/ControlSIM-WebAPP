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
                    {{ __('Información del cliente') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('Información sobre el cliente seleccionado al cual se le creara la cotización') }}
                </x-slot>
                <x-slot name="form">
                    <div class="col-span-4 sm:col-span-2" wire:ignore>
                        <x-jet-label for="selectCliente" value="{{ __('Seleccione Cliente') }}" />
                        <select name="selectCliente" id="selectCliente" class="select2 block mt-1 w-full border-gray-300 focus:border-csim focus:ring focus:ring-csim focus:ring-opacity-50 rounded-md shadow-sm">
                            <option value="">Seleccione un cliente</option>
                            @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->cli_razonsocial }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-2">
                        <x-jet-button wire:click.prevent="$emit('crearCliente')" class="my-6">{{ __('Añadir nuevo
                            cliente') }}</x-jet-button>
                        @livewire('clientes.create-clientes')
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="razon_cli" value="{{ __('Razon social') }}" />
                        <x-jet-input type="text" name="razon_cli" id="razon_cli" wire:model="razon_cli"
                            class="mt-1 block w-full disabled" disabled></x-jet-input>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="giro_cli" value="{{ __('Giro') }}" />
                        <x-jet-input type="text" name="giro_cli" id="giro_cli" wire:model="giro_cli"
                            class="mt-1 block w-full disabled" disabled></x-jet-input>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="rut_cli" value="{{ __('Rut') }}" />
                        <x-jet-input type="text" name="rut_cli" id="rut_cli" wire:model="rut_cli"
                            class="mt-1 block w-full disabled" disabled></x-jet-input>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="direccion_cli" value="{{ __('Direccion') }}" />
                        <x-jet-input type="text" name="direccion_cli" id="direccion_cli"
                            wire:model="direccion_cli" class="mt-1 block w-full disabled" disabled></x-jet-input>
                    </div>
                </x-slot>
            </x-jet-form-section>

            <x-jet-section-border />

            @if ($select_id)
                <x-jet-form-section submit="submitCotizacion">
                    <x-slot name="title">
                        {{ __('Productos y servicios') }}
                    </x-slot>
                    <x-slot name="description">
                        {{ __('Listado de productos y servicios') }}
                    </x-slot>
                    <x-slot name="form">
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-button class="m-1" wire:click.prevent="addProduct">Añadir</x-jet-button>
                        </div>
                        <div class="col-span-6">
                            <table class=" table-fixed w-full text-base text-left overflow-auto">
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
                                                <input type="hidden" name="cotizacionItems[{{ $index }}][producto_id]"
                                                wire:model="cotizacionItems.{{ $index }}.producto_id">
                                                @if ($cotizacionItem['prod_nombre'] && $cotizacionItem['prod_valor'])
                                                    {{ $cotizacionItem['prod_nombre'] }} ({{  '$'.number_format($cotizacionItem['prod_valor'],0,",",".") }})
                                                @endif
                                            @else
                                                <div wire:ignore>
                                                    <select name="cotizacionItems[{{ $index }}][producto_id]"
                                                        class="selectItem select2 w-52"
                                                        wire:model="cotizacionItems.{{ $index }}.producto_id">
                                                        <option value="">Elija un producto</option>
                                                        @foreach ($allProductos as $item)
                                                        <option value="{{ $item->id }}">{{ $item->prod_nombre }} ({{'$'.number_format($item->prod_valor,0,",",".") }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('cotizacionItems'.$index.'producto_id'))
                                                    <em class="text-red-600 text-sm">
                                                        {{ $errors->first('cotizacionItems'.$index.'producto_id') }}
                                                    </em>
                                                @endif
                                            @endif
                                        </td>
                                        <td class="py-3 px-6">
                                            @if ($cotizacionItem['is_saved'])
                                            <input type="hidden" name="cotizacionItems[{{ $index }}][cantidad]"
                                                wire:model="cotizacionItems.{{ $index }}.cantidad">
                                            {{ $cotizacionItem['cantidad'] }}
                                            @else
                                            <x-jet-input type="number"
                                                name="cotizacionItems[{{ $index }}][cantidad]" class=""
                                                wire:model="cotizacionItems.{{ $index }}.cantidad" />
                                            @endif
                                        </td>
                                        <td class="py-3 px-6">
                                            @if ($cotizacionItem['is_saved'])
                                            <x-jet-secondary-button class="m-1"
                                                wire:click.prevent="editProduct({{ $index }})" wire:loading.attr="disabled">Editar
                                            </x-jet-secondary-button>
                                            @elseif($this->producto_id2)
                                            <x-jet-button class="m-1"
                                                wire:click.prevent="saveProduct({{ $index }})" wire:loading.attr="disabled">
                                                Guardar</x-jet-button>
                                            @endif
                                            <x-jet-danger-button class="m-1"
                                                wire:click.prevent="removeProduct({{ $index }})" wire:loading.attr="disabled">Eliminar
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-section-border class="col-span-6 sm:col-span-4" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <div class="lg:grid grid-cols-2">
                                <x-jet-label for="subtotal" value="{{ __('Subtotal') }}"
                                    class="text-lg ml-2 my-3 col-span-1" />
                                <x-jet-input type="text" name="subtotal" wire:model="subtotal"
                                    class="my-1 col-span-1" disabled />
                            </div>
                            <div class="lg:grid grid-cols-2">
                                <x-jet-label for="iva" value="{{ __('IVA (19%)') }}"
                                    class="text-lg ml-2 my-3 col-span-1" />
                                <x-jet-input type="text" name="iva" wire:model="iva" class="my-1 col-span-1"
                                    disabled />
                            </div>
                            <div class="lg:grid grid-cols-2">
                                <x-jet-label for="total" value="{{ __('Total') }}"
                                    class="text-lg ml-2 my-3 col-span-1" />
                                <x-jet-input type="text" name="total" wire:model="total" class="my-1 col-span-1"
                                    disabled />
                            </div>
                        </div>
                    </x-slot>
                    @if ($cotizacionItems)
                        <x-slot name="actions" >
                            <x-jet-button class="m-1" wire:click.prevent='submitCotizacion' wire:loading.attr="disabled">{{ __('Crear cotizacion') }}</x-jet-button>
                        </x-slot>
                    @endif
                </x-jet-form-section>

                <x-jet-section-border />

            @endif
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
        }).css('bg-red-600');
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
            @this.set('producto_id2', $(this).val());
        });
        });
    });
</script>
@endsection
