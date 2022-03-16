<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ListTask extends Component
{
    use WithPagination;

    protected $listeners = [
        'updateTask' => '$refresh',
    ];

    public $task; public $control; public $archive;

    public function mount(Task $task)
    {
        $this->task = $task;
        $last_seen = Activity::where('subject_type', 'LIKE', '%Task')->where('subject_id', $task->id)->where('description', 'seen')->where('causer_type', 'LIKE', '%User')->where('causer_id', Auth::id())->orderBy('created_at', 'desc');
        if($last_seen->first())
        {
            if($task->updated_at > $last_seen->first()->created_at) activity()->performedOn($task)->log('seen');
        }
        else activity()->performedOn($task)->log('seen');
    }

    public function render()
    {
        return view('livewire.tasks.list-task');
    }
}
