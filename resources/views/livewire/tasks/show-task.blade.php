<x-modal>
    <x-slot name="title">
        Užduoties informacija
    </x-slot>

    <x-slot name="status">
        <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ \AppHelper::statusColor($task->status) }} text-gray-700 float-right">
            {{ \AppHelper::statusName($task->status) }}
        </div>
{{--        @if ($task->status === 0) <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-700 float-right">Laukiama</div>--}}
{{--        @elseif ($task->status === 1) <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-300 text-gray-700 float-right">Vykdoma</div>--}}
{{--        @elseif ($task->status === 2) <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-gray-700 float-right">Užbaigta</div>--}}
{{--        @elseif ($task->status === 3) <div class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-gray-700 float-right">Atšaukta</div>--}}
{{--        @endif--}}
    </x-slot>

    <x-slot name="content">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Pavadinimas
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $task->name }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Aprašymas
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @isset($task->details) {!! $task->details !!} @endisset
                    @empty($task->details) <i>nėra</i> @endempty
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Atlikimo laikas
                </dt>
                <dd class="mt-1 text-sm @if ($task->date_finish < date("Y-m-d H:i:s") && !$archive) text-red-600 font-bold @else text-gray-900 @endif sm:mt-0 sm:col-span-2">
                    @if($task->date_start === null)
                        iki
                    @elseif($task->date_start != $task->date_finish)
                        {{$task->date_start}} -
                    @else
                        tiksliai
                    @endif
                    {{ $task->date_finish }}
                </dd>
            </div>
            @role('admin')
                @if(isset($task->finish_location))
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Užbaigimo vieta
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($task->finish_location === 'error')
                                <i>klaida gaunant vietą</i>
                            @else
                                <iframe class="w-full" height="250" src="https://www.google.com/maps/embed/v1/place?q={{ $task->finish_location }}&key=AIzaSyCyXEWelcOyav6V31LoReRD_6It6i57C-A" allowfullscreen></iframe>
                            @endif
                        </dd>
                    </div>
                @endif
            @endrole
            @if($archive)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Užbaigimo laikas
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $task->updated_at }}
                    </dd>
                </div>
            @endif
            @if($control)
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Paskirtas vartotojas
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $task->User->name }}
                    </dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Užduoties kartojimas
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        @if(isset($task->repeat_duration))
                            {{ $task->repeat_duration }}
                            @switch($task->repeat_type)
                                @case('day') d. @break
                                @case('month') mėn. @break
                                @case('year') m. @break
                            @endswitch
                        @else
                            <i>nėra</i>
                        @endif
                    </dd>
                </div>
            @endif
        </dl>
    </x-slot>

    <x-slot name="buttons">
        <span wire:loading wire:target="continueWithLocation('completeWithLocation')" class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-700">
            Išsaugoma...
        </span>
        @if ($task->status === 0 && !$control) <x-jet-button wire:loading.attr="disabled" wire:click="start">Vykdyti</x-jet-button>&nbsp @endif
        @if ($task->status < 2)
            @if(!$control || auth()->user()->can('task edit'))
                @if($task->require_location)
                    <x-jet-button wire:loading.attr="disabled" wire:click="continueWithLocation('completeWithLocation')">Užbaigti</x-jet-button>&nbsp
                @else
                    <x-jet-button wire:loading.attr="disabled" wire:click="complete([])">Užbaigti</x-jet-button>&nbsp
                @endif
            @endif
            @can('task edit')
                <x-jet-button wire:click="cancel">Atšaukti</x-jet-button>&nbsp
                <x-jet-button wire:click="$emit('openModal', 'tasks.control.edit-task', {{ json_encode(['task' => $task])}})">Redaguoti</x-jet-button>&nbsp
            @endcan
        @endif
        <x-jet-button wire:click="closeModal">Uždaryti</x-jet-button>&nbsp
    </x-slot>
</x-modal>
