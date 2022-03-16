<tr class="hover:bg-gray-50" wire:click="$emit('openModal', 'notes.show-note', {{ json_encode(['note' => $note]) }})">
    <td class="px-2 py-4">
        <div class="text-sm text-gray-800 truncate"> {{ $note->name }}</div>
    </td>
    <td class="px-2 py-4">
        <div class="text-sm text-gray-800 truncate"> {{ $note->Category->name }}</div>
    </td>
    <td class="px-2 py-4">
        <div class="text-sm text-gray-800 truncate"> {{ $note->updated_at }}</div>
    </td>
    <td class="px-2 py-4 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 float-right" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </td>
</tr>
