<x-modal formAction="store">
    <x-slot name="title">
        Nauja užrašų kategorija
    </x-slot>

    <x-slot name="content">
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Pavadinimas</label>
                    <input type="text" name="name" id="name" wire:model="name" class="mt-1 focus:ring-indigo-200 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required/>
                    @error('name') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-jet-button type="submit">Pateikti</x-jet-button>&nbsp
        <x-jet-button wire:click="$emit('closeModal')">Atšaukti</x-jet-button>&nbsp
    </x-slot>
</x-modal>
