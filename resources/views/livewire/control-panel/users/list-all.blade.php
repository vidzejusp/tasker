<div class="flex flex-wrap lg:flex-nowrap py-5">
    {{--  Users add  --}}
    <div class="w-full lg:w-1/3 m-2">
        <div class="h-auto bg-white shadow-lg sm:rounded-md p-4">
            <form wire:submit.prevent="create" method="POST" >
                @csrf
                <div>
                    <x-jet-label for="name" value="{{ __('Vartotojo vardas') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')" required/>
                    @error('name') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="username" value="{{ __('Prisijungimo vardas') }}" />
                    <x-jet-input id="username" class="block mt-1 w-full" type="text" wire:model="username" :value="old('username')" required/>
                    @error('username') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Slaptažodis') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" wire:model="password" required />
                    @error('password') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <label for="role" value="" >{{ __('Rolė') }}</label>
                    <select id="role"  class="block mt-1 w-full" wire:model="role" required/>
                        @foreach($roles as $data)
                            <option value="{{ $data }}">
                                {{ \AppHelper::roleName($data) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-jet-button type="submit" class="mt-4">Sukurti</x-jet-button>
                <x-jet-action-message class="mr-3" on="create">
                    {{ __('Vartotojas sukurtas') }}
                </x-jet-action-message>
            </form>
        </div>
    </div>

    {{--  Users list  --}}
    <div class="w-full lg:w-2/3 bg-white shadow-lg sm:rounded-md p-0 m-2 border-box overflow-hidden">
        <table class="w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-2 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Vartotojo vardas
                    </th>
                    <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Prisijungimo vardas
                    </th>
                    <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        Rolė
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-2 py-4 text-sm text-gray-800 text-center">
                            {{ $user->id }}
                        </td>
                        <td class="px-2 py-4 text-sm text-gray-800">
                            {{ $user->name }}
                        </td>
                        <td class="px-2 py-4 text-sm text-gray-800 text-center">
                            {{ $user->username }}
                        </td>
                        <td class="px-2 py-4 text-sm text-gray-800 text-center">
                            {{ \AppHelper::roleName($user->companyRole()) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
{{--        @if($links->links())--}}
{{--            <div class="px-2 py-1">--}}
{{--                {{ $links->links() }}--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
</div>
