<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vartotojų valdymas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @livewire('control-panel.users')
                @livewire('control-panel.employees')
            </div>
        </div>
    </div>
</x-app-layout>
