<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Productos y Servicios') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <div class="justify-self-start">
                        @can('productos_create')
                        <x-jet-button wire:click="$emit('crearProducto')">{{ __('Añadir nuevo producto/servicio') }}</x-jet-button>
                        @endcan
                    </div>
                </div>
                <div class="m-5">
                    <livewire:productos.producto-table />
                </div>
                {{-- <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                ID
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Nombre
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Valor
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ 'PS-'.str_pad($producto->id,5,'0',STR_PAD_LEFT) }}</td>
                            <td class="py-3 px-6">{{ $producto->prod_nombre }}</td>
                            <td class="py-3 px-6">{{ '$'.number_format($producto->prod_valor,0,",",".") }}</td>
                            <td class="py-3 px-6">
                                <x-jet-button wire:click="$emit('modificarProducto', {{ $producto }}) ">{{ __('Editar') }}</x-jet-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($productos->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $productos->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_prod }}"
                </div>
                @endif --}}
            </div>
        </div>
    </div>

    @livewire('productos.create-productos')
    @livewire('productos.update-productos')
</div>
