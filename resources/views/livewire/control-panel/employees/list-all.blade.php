<div class="flex flex-wrap lg:flex-nowrap">
    {{--  Users add  --}}
    <div class="w-full lg:w-1/3 m-2">
        <div class="h-auto bg-white shadow-lg sm:rounded-lg p-4">
            <form wire:submit.prevent="create" method="POST">
                @csrf
                <div>
                    <x-jet-label for="name" value="{{ __('Darbuotojo vardas, pavardė') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')" required/>
                    @error('name') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label for="user_id" value="" >{{ __('Vartotojas') }}</label>
                    <select id="user_id"  class="block mt-1 w-full" wire:model="user_id" required>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <x-jet-button type="submit" class="mt-4">Sukurti</x-jet-button>
                <x-jet-action-message class="mr-3" on="create">
                    {{ __('Darbuotojas sukurtas') }}
                </x-jet-action-message>
            </form>
        </div>
    </div>

    {{--  Employees list  --}}
    <div class="w-full lg:w-2/3 bg-white shadow-lg sm:rounded-md p-0 m-2 border-box overflow-hidden">
        <table class="w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    #
                </th>
                <th scope="col" class="px-2 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Darbuotojo vardas
                </th>
                <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Priskirtas vartotojas
                </th>
                <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    PIN kodas
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                @foreach($user->employees as $employee)
                <tr class="hover:bg-gray-50">
                    <td class="px-2 py-4 text-sm text-gray-800 text-center">
                        {{ $employee->id }}
                    </td>
                    <td class="px-2 py-4 text-sm text-gray-800">
                        {{ $employee->name }}
                    </td>
                    <td class="px-2 py-4 text-sm text-gray-800 text-center">
                        {{ $user->name }}
                    </td>
                    <td class="px-2 py-4 text-sm text-gray-800 text-center">
                        {{ $employee->passcode }}
                    </td>
                </tr>
                @endforeach
            @empty
                <div class="text-center text-md text-gray-800 tracking-wider">Nerasta vartotojų</div>
            @endforelse
            </tbody>
        </table>
{{--        @if($links->links())--}}
{{--            <div class="px-2 py-1">--}}
{{--                {{ $links->links() }}--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
</div>
