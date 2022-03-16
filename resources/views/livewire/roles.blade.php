<div class="flex flex-wrap lg:flex-nowrap">
    {{--  Roles add  --}}
    <div class="w-full lg:w-1/3 m-2">
        <div class="h-auto bg-white shadow-lg sm:rounded-lg p-4">
            <form wire:submit.prevent="create" method="POST">
                @csrf
                <div>
                    <x-jet-label for="name" value="{{ __('Grupės pavadinimas') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')" required/>
                    @error('name') <span class="error text-red-600 font-bold">{{ $message }}</span> @enderror
                </div>
                <x-jet-button type="submit" class="mt-4">Sukurti</x-jet-button>
                <x-jet-action-message class="mr-3" on="create">
                    {{ __('Grupė sukurta') }}
                </x-jet-action-message>
            </form>
        </div>
    </div>

    {{--  Roles list  --}}
    <div class="w-full lg:w-2/3 bg-white shadow-lg sm:rounded-lg p-4 m-2">
        <table class="table-auto w-full divide-y divide-gray-200">
            <thead>
            <tr>
                <th>#</th>
                <th>Pavadinimas</th>
                <th>Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @if ($roles->count() > 0)
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>Edit</td>
                    </tr>
                @endforeach
            @else
                Sąrašas tuščias
            @endif
            </tbody>
        </table>
    </div>
</div>
