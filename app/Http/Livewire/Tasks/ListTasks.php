<?php

namespace App\Http\Livewire\Tasks;

use App\Models\Task;
use App\Models\TaskArchive;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ListTasks extends Component
{
    use WithPagination;

    protected $listeners = [
        'updateTasks' => '$refresh',
    ];

    public $tasks; public $archive; public $control;

    public function render()
    {
//        dd(Activity::forSubject(Task::find(2)));
//        dd(Activity::where('subject_type', 'LIKE', '%Task')->where('subject_id', 2)->get());
        if($this->control)
        {
            if($this->archive) $this->tasks = TaskArchive::where('company_id', Auth::user()->current_company)->orderBy('date_finish')->paginate(10);
            else $this->tasks = Task::where('company_id', Auth::user()->current_company)->orderBy('date_finish')->paginate(10);
        }
        else
        {
            if($this->archive) $this->tasks = TaskArchive::where('user_id', Auth::user()->id)->where('company_id', Auth::user()->current_company)->orderBy('date_finish')->paginate(10);
            else $this->tasks = Task::where('user_id', Auth::user()->id)->where('company_id', Auth::user()->current_company)->orderBy('date_finish')->paginate(10);
        }
        $links = $this->tasks;
        $this->tasks = collect($this->tasks->items());
        return view('livewire.tasks.list-tasks',
        [
            'tasks' => compact($this->tasks),
            'links' => $links,
        ]);
    }
}
