<?php

namespace App\Http\Livewire\Tasks\Archive;

//use Livewire\Component;
use App\Helpers\AppHelper;
use App\Models\Task;
use App\Models\TaskArchive;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ShowTask extends ModalComponent
{
    public $task; public $control; public $archive;

    public $listeners = [
        'updateTask' => 'render',
    ];

    public function mount(TaskArchive $task)
    {
        AppHelper::checkPermission('task edit');
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.tasks.show-task');
    }
}
