<?php

namespace App\Http\Livewire\Tasks\Control;

use App\Events\TaskAdded;
use App\Helpers\AppHelper;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class CreateTask extends ModalComponent
{
    public $showNewTaskNotification = false;

    protected $listeners = ['tasks,TaskAdded' => 'notifyNewTask'];

    public $name;
    public $user_id;
    public $details;
    public $date_type;
    public $date_finish;
    public $date_start;
    public $repeat_duration;
    public $repeat_type;
    public $require_location;
    public $location;
    public $show;

    public function mount() {
        AppHelper::checkPermission('task edit');
        $this->user_id = Auth::user()->company->users->first()->id;
        $this->repeat_type = "day";
        $this->date_start = date('Y-m-d\TH:i');
        $this->date_finish = date('Y-m-d\TH:i');
        $this->date_type = 1;
        $this->require_location = 1;
        $this->show = false;
    }

    public function render() {
        return view('livewire.tasks.control.create-task');
    }

    public function date_type() {
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

    public function store() {
        switch ($this->date_type)
        {
            case 1:
                $this->date_start = null;
                break;
            case 3:
                $this->date_start = $this->date_finish;
                break;
        }
//        dd($this->request_location);
        $task = Task::create([
            'name' => $this->name,
            'user_id' => $this->user_id,
            'company_id' => Auth::user()->current_company,
            'details' => $this->details,
            'date_start' => $this->date_start,
            'date_finish' => $this->date_finish,
            'repeat_duration' => $this->repeat_duration,
            'repeat_type' => $this->repeat_type,
            'require_location' => $this->require_location,
            'location' => $this->location,
            'created_by' => Auth::id(),
        ]);
        $task->save();
        $this->sendNotification();
//        event(new TaskAdded(User::find($this->user_id)));
        $this->emit('updateTasks');
        $this->closeModal();
    }

    public function notifyNewTask()
    {
        $this->showNewTaskNotification = true;
    }

    public function sendNotification()
    {
        $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
            "instanceId" => env('PUSHER_APP_ID'),
            "secretKey" => env('PUSHER_APP_SECRET'),
        ));

        $beamsClient->publishToInterests(
            array('App.User.'.$this->user_id),
            array("web" => array("notification" => array(
                "title" => "Priskirta nauja užduotis!",
                "body" => $this->name,
                "icon" => asset('favicon.ico')
            )),
            ));
    }
}
