<div class="p-6 sm:px-20 bg-white border-b border-gray-200">

    <div class="mt-8 text-2xl grid-cols-2 flex justify-between">
        <div class="col-span-1">
            Bienvenido {{ auth()->user()->us_nombre }} {{ auth()->user()->us_apellido }}
        </div>
        <div class="col-span-1">
            <x-jet-button wire:click='exportActividad'>{{ __('Descargar log de actividad') }}</x-jet-button>
        </div>
        <div class="col-span-1 w-52 pb-6" wire:ignore>
            <x-jet-label for="select_fecha" value="{{ __('Cargo') }}" />
                    <select name="select_fecha" id="select_fecha" wire:model='select_fecha' wire:change='$refresh' default=''
                        class="selectFecha select2 w-full"
                        value=''>
                        <option selected value="">Actual</option>
                        @for ( $i=0 ; $i <= $this->mes_count+1 ; $i++)
                            <option value="{{ \Carbon\Carbon::now()->subMonths($i) }}">{{ \Carbon\Carbon::now()->subMonths($i) }}</option>
                        @endfor
                    </select>
                    <x-jet-input-error for="select_fecha" class="mt-2" />
        </div>
    </div>

    <div class="mt-6 text-gray-500">

    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l md:border-r">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Cotizaciones este mes</div>
        </div>

        <div class="ml-12 h-96">
            <livewire:livewire-column-chart
                :column-chart-model="$columnChartModel"
            />
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l md:border-r">
        <div class="flex items-center">
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Trabajos este mes</div>
        </div>

        <div class="ml-12 h-96">
            <livewire:livewire-column-chart
                :column-chart-model="$columnChartModel2"
            />
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        $('.selectFecha').select2({
            placeholder: 'Seleccione una fecha',
            "language": {
                "noResults": function(){
                    return "No hay coincidencias"
                }
            }
        });
        $('.selectFecha').on('change', function(e) {
            @this.set('select_fecha2', $(this).val())
        });
    });
</script>
@endsection
