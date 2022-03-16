<?php

namespace App\Http\Livewire\Notes;

use App\Helpers\AppHelper;
use App\Http\Livewire\Functions;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;
use Livewire\Component;

class ShowNote extends ModalComponent
{
    public $note;

    protected $listeners = [
        'updateNote' => '$refresh',
    ];



    public function mount(Note $note)
    {
        AppHelper::checkPermission('notes view');
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.notes.show-note');
    }

//    protected function update()
//    {
//        $this->emit("openModal", "notes.control.update", ["note" => $this->note]);
//    }
}
