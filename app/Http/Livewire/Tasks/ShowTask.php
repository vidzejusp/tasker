<?php

namespace App\Http\Livewire\Tasks;

//use Livewire\Component;
use App\Helpers\AppHelper;
use App\Http\Livewire\Functions;
use App\Models\Task;
use App\Models\TaskArchive;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ShowTask extends ModalComponent
{
    public $task; public $control; public $archive; public $location;

    protected $listeners = [
        'updateTask' => '$refresh',
        'completeWithLocation' => 'complete',
    ];

    public function mount(Task $task)
    {
        AppHelper::checkPermission('task view');
        $this->task = $task;
    }

    public function render()
    {

        return view('livewire.tasks.show-task');
    }

    public function start()
    {
        AppHelper::checkPermission('task update');
        $this->task->status = 1;
        $this->task->save();
        $this->render();
    }

    public function continueWithLocation($callback)
    {
        $this->emit('getLocation', ['callback' => $callback]);
    }

    public function complete($data = null)
    {
        AppHelper::checkPermission('task update');
        if(isset($data['location'])) {
            $this->task->finish_location = $data['location'];
        }
        else $this->task->finish_location = null;
        $newTask = $this->task->replicate();
        $newTask->id = null;
        if($this->task->repeat_duration) {
            $date_start = new DateTime($newTask->date_start);
            $date_finish = new DateTime($newTask->date_finish);
            $date_start->modify('+' . $newTask->repeat_duration . ' ' . $newTask->repeat_type);
            $date_finish->modify('+' . $newTask->repeat_duration . ' ' . $newTask->repeat_type);
            if($this->task->date_start) $newTask->date_start = $date_start->format("Y-m-d H:i");
            else $newTask->date_start = $this->task->date_start;
            $newTask->date_finish = $date_finish->format("Y-m-d H:i");
            $newTask->finish_location = null;
            $newTask->save();
        }
        $this->task->status = 2;
        if(Auth::user()->HasEmployees()) $this->task->completed_by = Auth::user()->employee->name;
        else $this->task->completed_by = Auth::user()->name;
        $this->archiveTask();
        $this->emit('updateTasks');
        $this->forceClose()->closeModal();
    }

    public function cancel()
    {
        AppHelper::checkPermission('task edit');
        $this->task->status = 3;
        if(Auth::user()->HasEmployees()) $this->task->completed_by = Auth::user()->employee->name;
        else $this->task->completed_by = Auth::user()->name;
        $this->archiveTask();
        $this->emit('updateTasks');
        $this->forceClose()->closeModal();

    }

    protected function archiveTask()
    {
        $this->task->save();
        TaskArchive::create($this->task->toArray());
        $this->task->delete();
    }
}
