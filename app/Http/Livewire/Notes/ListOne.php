<?php

namespace App\Http\Livewire\Notes;

use App\Models\Note;
use Livewire\Component;

class ListOne extends Component
{
    protected $listeners = [
        'updateNote' => '$refresh',
    ];

    public $note;

    public function mount(Note $note)
    {
        $this->note = $note;
    }

    public function render()
    {
        return view('livewire.notes.list-one');
    }
}
