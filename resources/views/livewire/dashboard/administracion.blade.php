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
            @foreach ($this->actividades as $actividad)
            <h1 class="font-bold my-2 text-m">{{ $actividad->causer->us_nombre }} {{ $actividad->causer->us_apellido }}{{ __(' ha ') }}{{ $actividad->description }}{{ __(' un/a ') }}{{ $actividad->log_name }}</h1>
            @endforeach
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Cotizaciones este mes</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <h1 class="font-bold my-2 text-xl">Cotizaciones Emitidas: {{ $this->cotizacionesEmitidas }}</h1>
                <h1 class="font-bold my-2 text-xl text-green-500">Cotizaciones Aceptadas: {{ $this->cotizacionesAceptadas }}</h1>
                <h1 class="font-bold my-2 text-xl text-red-500">Cotizaciones Rechazadas: {{$this->cotizacionesRechazadas }}</h1>
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Trabajos este mes</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <h1 class="font-bold my-2 text-xl">Trabajos planificados: {{ $this->trabajosPlanificados }}</h1>
                <h1 class="font-bold my-2 text-xl text-yellow-500">Trabajos Iniciados: {{ $this->trabajosIniciados }}</h1>
                <h1 class="font-bold my-2 text-xl text-red-500">Trabajos Cancelados: {{$this->trabajosCancelados }}</h1>
                <h1 class="font-bold my-2 text-xl text-green-500">Trabajos Finalizados: {{$this->trabajosCompletados }}</h1>
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">

    </div>
</div>
