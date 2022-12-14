<x-jet-action-section>
    <x-slot name="title">
        {{ __('Contactos') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Crea y administra contactos para el cliente visualizado') }}
    </x-slot>
    <x-slot name="content">
        <div class="mt-5 md:mt-0 md:col-span-2">
            <table class=" w-full text-base text-left" >
                <thead class="uppercase">
                    <tr>
                        <th scope="col" class="py-2 px-6">
                            Nombre
                        </th>
                        <th scope="col" class="py-2 px-6">
                            Correo
                        </th>
                        <th scope="col" class="py-2 px-6">
                            Telefono
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($contactos as $contacto)
                        <tr class="bg-white border-b hover:bg-gray-300">
                            <td class="py-3 px-6">{{ $contacto->con_nombre }}</td>
                            <td class="py-3 px-6">{{ $contacto->con_email }}</td>
                            <td class="py-3 px-6">{{ $contacto->con_telefono }}</td>
                        </tr>
                    @endforeach --}}
                    <tr class="bg-white border-b hover:bg-gray-300">
                        <td class="py-3 px-6">{{ '0' }}</td>
                        <td class="py-3 px-6">{{ 'a' }}</td>
                        <td class="py-3 px-6">{{ 'b' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex items-center mt-5">
                <a href=""><button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-sm shadow-blue-500/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">Añadir contacto</button></a>
            </div>
        </div>
    </x-slot>
</x-jet-action-section>
