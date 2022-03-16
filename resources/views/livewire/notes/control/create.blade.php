<x-modal formAction="store">
    <x-slot name="title">
        Naujas užrašas
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Pavadinimas</label>
                    <input type="text" name="name" id="name" wire:model="name" class="mt-1 focus:ring-indigo-200 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required/>
                    @error('name') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Aprašymas</label>
                    <x-inputs.tinymce id="description" name="description" wire:model="description" rows="3" class="shadow-sm focus:ring-indigo-200 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Įrašyti..." /></textarea>
                </div>
                <div class="col-span-6">
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategorija <a class='float-right inline-block underline tracking-wide' wire:click="$emit('openModal', 'notes.control.create-category')">Pridėti naują</a></label>
                    <select id="category" name="category" wire:model="category" class="mt-1 inline-block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-200 sm:text-sm" required>
                        @forelse($categories as $data)
                            <option value='{{ $data->id }}'>{{ $data->name }}</option>
                        @empty
                            <option value=''>Sąrašas tuščias</option>
                        @endforelse
                    </select>
                </div>

                <div class="col-span-6 md:col-span-3">
                    <label class="flex leading-5">
                        <input type="checkbox" id="important" name="important" wire:model="important" class="mr-2 w-5 h-5 inline-block border border-gray-300 bg-white rounded shadow-sm focus:outline-none focus:ring-indigo-200" />
                        <span class="inline-block text-sm font-medium text-gray-700">Svarbus įrašas (rodyti viršuje)</span>
                    </label>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-jet-button type="submit">Pateikti</x-jet-button>&nbsp
        <x-jet-button wire:click="$emit('closeModal')">Atšaukti</x-jet-button>&nbsp
    </x-slot>
</x-modal>
