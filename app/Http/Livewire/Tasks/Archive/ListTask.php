<?php

namespace App\Http\Livewire\Tasks\Archive;

use App\Models\Task;
use App\Models\TaskArchive;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class ListTask extends Component
{
    use WithPagination;

    public $task; public $control; public $archive;

    public function mount(TaskArchive $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.tasks.list-task');
    }
}
