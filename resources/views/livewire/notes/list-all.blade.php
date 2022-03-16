<div class="shadow overflow-hidden border-b border-gray-200">
    @if($notes->count() > 0)
        <table class="w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-2 py-3 min-w-max text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Pavadinimas
                </th>
                <th scope="col" class="px-2 py-3 w-auto text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Kategorija
                </th>
                <th scope="col" class="px-2 py-3 w-auto text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Atnaujinta
                </th>
                <th scope="col" class="px-2 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider max-w-min">

                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($notes as $data)
                @livewire('notes.list-one', ['note' => $data], key($data->id))
            @endforeach
            </tbody>
        </table>
        @if($notes->links())
            <div class="px-2 py-1">
                {{ $notes->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5 font-medium text-gray-600 tracking-wider uppercase">Sąrašas tuščias</div>
    @endif
</div>
