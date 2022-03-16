<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Užduočių valdymas') }}
            <button onclick="Livewire.emit('openModal', 'tasks.control.create-task')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: inline !important;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </h2>

    </x-slot>

    <x-slot name="slot">
{{--        <button onclick="getLocation()">Try It</button>--}}

{{--        <p id="demo"></p>--}}
        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="text-center py-2 font-medium text-gray-600 tracking-wider uppercase border-b border-gray-200">
                        Aktyvios užduotys
                    </div>
                    @livewire('tasks.list-tasks', ['control' => true, 'archive' => false])
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="text-center py-2 font-medium text-gray-600 tracking-wider uppercase border-b border-gray-200">
                        Archyvas
                    </div>
                    @livewire('tasks.list-tasks', ['archive' => true, 'control' => true])
                </div>
            </div>
        </div>
    </x-slot>
{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                @livewire('tasks.control.list-tasks')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">--}}
{{--                @livewire('tasks.control.list-archive')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
