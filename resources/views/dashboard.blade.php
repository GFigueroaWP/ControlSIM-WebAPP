<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @role(['Técnico', 'super-admin'])
                    @livewire('dashboard.tecnico')
                @endrole
                @role(['Administrativo','super-admin'])
                    @livewire('dashboard.administracion')
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
