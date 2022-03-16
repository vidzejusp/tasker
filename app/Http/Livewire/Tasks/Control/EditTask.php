<?php

namespace App\Http\Livewire\Tasks\Control;

use App\Helpers\AppHelper;
use App\Models\Task;
use DateTime;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditTask extends ModalComponent
{
    public $task; public $show; public $date_type;

    protected $rules = [
        'name' => 'required|string',
        'details' => 'nullable|string',
        'require_location' => 'boolean',
        'repeat_duration' => 'nullable|integer',
        'repeat_type' => 'nullable|string',
        'date_start' => 'nullable',
        'date_finish' => 'required',
        'user_id' => 'required|integer',
    ];

    public function mount(Task $task)
    {
        AppHelper::checkPermission('task edit');
        $this->task = $task;
        $this->name = $task->name;
        $this->details = $task->details;
        $this->user_id = $task->user_id;
        if($task->date_start === null) {
            $this->date_type = 1;
        }
        elseif($task->date_start != $task->date_finish) {
            $this->date_type = 2;
        }
        else {
            $this->date_type = 3;
        }
        $this->set_type();
        $date_start = new DateTime($task->date_start);
        $this->date_start = $date_start->format("Y-m-d\TH:i");
        $date_finish = new DateTime($task->date_finish);
        $this->date_finish = $date_finish->format("Y-m-d\TH:i");
        $this->repeat_duration = $task->repeat_duration;
        $this->repeat_type = $task->repeat_type;
        $this->location = $task->location;
        $this->require_location = $task->require_location;
    }

    public function render()
    {
        return view('livewire.tasks.control.edit-task');
    }

    public function set_type() {
        switch ($this->date_type) {
            case 1:
            case 3:
                $this->show = false;
                break;
            case 2:
                $this->show = true;
                break;
        }
    }

    public function save()
    {
        switch ($this->date_type)
        {
            case 1:
                $this->date_start = null;
                break;
            case 3:
                $this->date_start = $this->date_finish;
                break;
        }
        $this->task->update($this->validate());
        $this->emit('updateTask');
        $this->closeModal();
    }
}
