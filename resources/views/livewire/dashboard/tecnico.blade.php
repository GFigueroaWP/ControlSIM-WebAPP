<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="mt-8 text-2xl">
        Bienvenido {{ auth()->user()->us_nombre }} {{ auth()->user()->us_apellido }}
    </div>

    <div class="mt-6 text-gray-500">

    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Últimos eventos</div>
        </div>

        <div class="ml-12">

        </div>
    </div>

    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Trabajos este mes</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <h1 class="font-bold my-2 text-xl">Trabajos Asignados: {{ $this->trabajosAsignados }}</h1>
                <h1 class="font-bold my-2 text-xl text-yellow-500">Trabajos en progreso: {{ $this->trabajosIniciados }}</h1>
                <h1 class="font-bold my-2 text-xl text-green-500">Trabajos Finalizados: {{$this->trabajosCompletados }}</h1>
            </div>
        </div>
    </div>
</div>