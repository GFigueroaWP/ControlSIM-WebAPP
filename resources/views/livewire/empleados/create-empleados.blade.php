<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Añadir empleado') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="relative shadow-md sm:rounded-lg p-5">
                <x-jet-validation-errors class="mb-4" />
                <form wire:submit.prevent='submit' class="space-y-4">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="us_username" class="block mb-2 text-sm font-medium text-gray-900 ">Usuario</label>
                            <input wire:model='us_username' type="text" id="us_username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="usuario">
                        </div>
                        <div>
                            <label for="us_rut" class="block mb-2 text-sm font-medium text-gray-900 ">Rut</label>
                            <input wire:model='us_rut' wire:change="formatRut" wire:keyup="formatRut" type="text" id="us_rut"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="12345678-0">
                        </div>
                        <div>
                            <label for="us_nombre" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre</label>
                            <input wire:model='us_nombre' type="text" id="us_nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Nombre">
                        </div>
                        <div>
                            <label for="us_apellido" class="block mb-2 text-sm font-medium text-gray-900 ">Apellido</label>
                            <input wire:model='us_apellido' type="text" id="us_apellido"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Apellido">
                        </div>
                        <div>
                            <label for="us_telefono" class="block mb-2 text-sm font-medium text-gray-900 ">Teléfono</label>
                            <input wire:model='us_telefono' type="text" id="us_telefono"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="912345678">
                        </div>
                        <div>
                            <label for="us_email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                            <input wire:model='us_email' type="text" id="us_email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="user@email.cl">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Contraseña</label>
                            <input wire:model='password' type="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="*********">
                        </div>
                        <div>
                            <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900 ">Cargo</label>
                            <select name="cargo" id="cargo" wire:model='cargo' default='empleado'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($cargos as $cargo)
                                    @if ($cargo!='super-admin')
                                        <option value="{{ $cargo }}">{{ $cargo }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Crear
                        usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
