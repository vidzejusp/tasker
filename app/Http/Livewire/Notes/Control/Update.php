<?php

namespace App\Http\Livewire\Notes\Control;

use App\Helpers\AppHelper;
use App\Models\Note;
use App\Models\NotesCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Update extends ModalComponent
{
    public $listeners = [
        'setNoteCategory' => 'setCategory',
    ];

    public static function destroyOnClose(): bool
    {
        return true;
    }

    protected $rules = [
        'name' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|integer',
        'important' => 'boolean',
    ];

    public $note;

    public function mount(Note $note)
    {
        AppHelper::checkPermission('notes edit');
        $this->note = $note;
        $this->name = $note->name;
        $this->description = $note->description;
        $this->category = $note->category;
        $this->important = $note->important;
    }

    public function render()
    {
        $categories = NotesCategory::where('company_id', Auth::user()->current_company)->get();
        return view('livewire.notes.control.update', [
            'categories' => $categories,
        ]);
    }

    public function update()
    {
        $this->note->update($this->validate());
        $this->emit('updateNote');
//        $this->emit('updateNotes');
        $this->closeModalWithEvents([
            'updateNotes'
        ]);
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
