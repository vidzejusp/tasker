<?php

namespace App\Http\Livewire\Notes\Control;

use App\Helpers\AppHelper;
use App\Models\Note;
use App\Models\NotesCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $listeners = [
        'setNoteCategory' => 'setCategory',
    ];

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public $name; public $description; public $category; public $important;

    public function mount()
    {
        AppHelper::checkPermission('notes create');
        $this->important = 0;
        $firstCategory = NotesCategory::where('company_id', Auth::user()->current_company)->first();
        if($firstCategory != '') $this->category = $firstCategory->id;
        else $this->category = null;
    }

    public function render()
    {
        $categories = NotesCategory::where('company_id', Auth::user()->current_company)->get();
        return view('livewire.notes.control.create', [
            'categories' => $categories,
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required'],
            'category' => ['integer', 'required'],
        ]);
//        dd($this);
        $note = Note::create([
            'name' => $this->name,
            'description' => $this->description,
            'important' => $this->important,
            'category' => $this->category,
            'created_by' => Auth::id(),
        ]);
        $note->save();
        $this->emit('updateNotes');
        $this->closeModal();
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }
}
