<div class="shadow overflow-hidden border-b border-gray-200">
    @if($tasks->count() > 0)
        <table class="w-full divide-y divide-gray-200 table-fixed">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-2 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Pavadinimas
                </th>
                <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-20">
                    Statusas
                </th>
                @if($control)
                <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">
                    @if($archive) Užbaigė @else Vartotojas @endif
                </th>
                @endif
                <th scope="col" class="px-2 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-48">

                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if($archive)
                    @foreach($tasks as $task)
                        @livewire('tasks.archive.list-task', ['task' => $task, 'control' => $control, 'archive' => $archive], key($task->id))
                    @endforeach
                @else
                    @foreach($tasks as $task)
                        @livewire('tasks.list-task', ['task' => $task, 'control' => $control, 'archive' => $archive], key($task->id))
                    @endforeach
                @endif
            </tbody>
        </table>
        @if($links->links())
            <div class="px-2 py-1">
                {{ $links->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5 font-medium text-gray-600 tracking-wider uppercase">Sąrašas tuščias</div>
    @endif
</div>
