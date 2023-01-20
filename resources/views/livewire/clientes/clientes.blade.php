<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Listado de clientes') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <div class="flex justify-between items-center p-4">
                    <div class="justify-self-start">
                        @can('clientes_create')
                        <x-jet-button wire:click="$emit('crearCliente')">{{ __('Crear nuevo Cliente') }}</x-jet-button>
                        @endcan
                    </div>
                </div>
                <div class="m-5">
                    <livewire:clientes.cliente-table />
                </div>
                {{-- <table class=" w-full text-base text-left">
                    <thead class="uppercase">
                        <tr>
                            <th scope="col" class="py-2 px-6">
                                Rut
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Razón Social
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Giro
                            </th>
                            <th scope="col" class="py-2 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ $cliente->cli_rut }}</td>
                            <td class="py-3 px-6">{{ $cliente->cli_razonsocial }}</td>
                            <td class="py-3 px-6">{{ $cliente->cli_giro }}</td>
                            <td class="py-3 px-6">
                                @can('clientes_edit')
                                <a href="{{ route('showClientes', ['cliente' => $cliente->id]) }}">
                                    <x-jet-button>{{ __('Ver') }}</x-jet-button>
                                </a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($clientes->count())
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    {{ $clientes->links() }}
                </div>
                @else
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    No hay resultados para la búsqueda "{{ $filtro_cli }}"
                </div>
                @endif --}}
            </div>
        </div>
    </div>

    {{-- Modal de creación de cliente --}}
    @livewire('clientes.create-clientes')
</div>
