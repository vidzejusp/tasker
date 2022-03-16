<x-modal formAction="store">
    <x-slot name="title">
        Nauja užduotis
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
                    <label for="details" class="block text-sm font-medium text-gray-700">Aprašymas</label>
                    <x-inputs.tinymce id="details" name="details" wire:model="details" rows="3" class="shadow-sm focus:ring-indigo-200 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Įrašyti..." /></textarea>
                </div>

                <div class="col-span-6">
                    <label for="date_type" class="block text-sm font-medium text-gray-700">Termino tipas</label>
                    <select id="date_type" name="date_type" wire:model="date_type" wire:change="date_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-200 sm:text-sm" required/>
                        <option value='1'>Atlikti iki</option>
                        <option value='2'>Atlikti laikotarpiu</option>
                        <option value='3'>Atlikti tiksliu laiku</option>
                    </select>
                </div>
                @if($show)
                <div class="col-span-6 md:col-span-3">
                    <label for="date_start" class="block text-sm font-medium text-gray-700">Atlikimo laiko pradžia</label>
                    <input type="datetime-local" id="date_start" wire:model="date_start" class="shadow-sm focus:ring-indigo-200 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" required/>
                </div>
                @endif
                <div class="col-span-6 md:col-span-3">
                    <label for="date_finish" class="block text-sm font-medium text-gray-700">Atlikimo laiko pabaiga</label>
                    <input type="datetime-local" id="date_finish" wire:model="date_finish" class="shadow-sm focus:ring-indigo-200 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" required/>
                </div>

                <div class="col-span-6">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Vartotojas</label>
                    <select id="user_id" name="user_id" wire:model="user_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-200 sm:text-sm" required/>
                        @foreach(Auth::user()->company->users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-6">
                    <label for="location" class="block text-sm font-medium text-gray-700">Vieta</label>
                    <input type="text" id="location" wire:model="location" class="shadow-sm focus:ring-indigo-200 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"/>
                </div>

                <div class="col-span-6 md:col-span-3">
                    <label for="repeat_duration" class="block text-sm font-medium text-gray-700">Užduoties kartojimas</label>
                    <input type="number" name="repeat_duration" id="repeat_duration" wire:model="repeat_duration" placeholder="Įveskite skaičių..." class="mt-1 focus:ring-indigo-200 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 md:col-span-3">
                    <label for="repeat_type" class="block text-sm font-medium text-gray-700">&nbsp</label>
                    <select id="repeat_type" name="repeat_type" wire:model="repeat_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-200 sm:text-sm" />
                        <option value="day">
                            dienos
                        </option>
                        <option value="month">
                            mėnesiai
                        </option>
                        <option value="year">
                            metai
                        </option>
                    </select>
                </div>
                @role('admin')
                <div class="col-span-6 md:col-span-3">
                    <label class="flex leading-5">
                        <input type="checkbox" id="require_location" name="require_location" wire:model="require_location" class="mr-2 w-5 h-5 inline-block border border-gray-300 bg-white rounded shadow-sm focus:outline-none focus:ring-indigo-200" />
                        <span class="inline-block text-sm font-medium text-gray-700">Prašyti būvimo vietos užbaigiant</span>
                    </label>
{{--                    <label for="request_location" class=""></label>--}}
                </div>
                @endrole
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-jet-button type="submit">Pateikti</x-jet-button>&nbsp
        <x-jet-button wire:click="$emit('closeModal')">Atšaukti</x-jet-button>&nbsp
    </x-slot>
</x-modal>
