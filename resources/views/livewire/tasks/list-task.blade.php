@if($archive)
    <tr class="hover:bg-gray-50" wire:click="$emit('openModal', 'tasks.archive.show-task', {{ json_encode(['task' => $task, 'control' => $control, 'archive' => $archive]) }})">
@else
    <tr class="hover:bg-gray-50" wire:click="$emit('openModal', 'tasks.show-task', {{ json_encode(['task' => $task, 'control' => $control, 'archive' => $archive]) }})">
@endif
    <td class="px-2 py-4">
        <div class="text-sm text-gray-800 truncate"> {{ $task->name }}</div>
    </td>
    <td class="px-2 py-4 text-center whitespace-nowrap">
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ \AppHelper::statusColor($task->status) }} text-gray-700">{{ \AppHelper::statusName($task->status) }}</span>
    </td>
    @if($control)
        <td class="px-2 py-4 whitespace-nowrap text-sm text-center text-gray-800 ">
            @if($archive)
                {{ $task->completed_by }}
            @else
                {{ $task->User->name }}
            @endif
        </td>
    @endif
    <td class="px-2 py-4 text-sm text-center @if ($task->date_finish < date("Y-m-d H:i:s") && !$archive) text-red-600 font-bold @else text-gray-800 @endif">
        @if($archive)
            {{ $task->updated_at }}
        @else
            @if($task->date_start === null)
            iki
            @elseif($task->date_start != $task->date_finish)
                    {{$task->date_start}} <span class="hidden">-</span>
            @else
                tiksliai
            @endif
            {{ $task->date_finish }}
        @endif
    </td>
</tr>
