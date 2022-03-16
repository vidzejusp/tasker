<x-modal>
    <x-slot name="title">
        {{ $note->name }}
    </x-slot>

    <x-slot name="content">
        <dl>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Aprašymas
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    @isset($note->description) {!! $note->description !!} @endisset
                    @empty($note->description) <i>nėra</i> @endempty
                </dd>
                <dt class="text-sm font-medium text-gray-500">
                    Kategorija
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $note->Category->name }}
                </dd>
                @can('notes edit')
                    <dt class="text-sm font-medium text-gray-500">
                        Įrašas sukurtas
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $note->created_at }}
                    </dd>
                    <dt class="text-sm font-medium text-gray-500">
                        Paskutinis atnaujinimas
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{ $note->updated_at }}
                    </dd>
                @endcan
                <dt class="text-sm font-medium text-gray-500">
                    Įrašą sukūrė
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $note->Author->name }}
                </dd>
            </div>
        </dl>
    </x-slot>

    <x-slot name="buttons">
        @can('notes edit')
            <x-jet-button class="mr-2" wire:click="$emit('openModal', 'notes.control.update', {{ json_encode(['note' => $note]) }})">Redaguoti</x-jet-button>
        @endcan
        <x-jet-button wire:click="closeModal">Uždaryti</x-jet-button>&nbsp
    </x-slot>
</x-modal>

