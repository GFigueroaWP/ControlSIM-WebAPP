<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Información de empleado') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-auto">
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="updateEmpleado">
                <x-slot name="title">
                    {{ __('Información de empleado') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Informacion almacenada del empleado seleccionado') }}
                </x-slot>

                <x-slot name="form">

                </x-slot>

                <x-slot name="actions">

                </x-slot>
            </x-jet-form-section>
        </div>
    </div>
</div>
