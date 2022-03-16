<?php

namespace App\Http\Livewire\Notes\Control;

use App\Helpers\AppHelper;
use App\Models\NotesCategory;
use App\Rules\CategoryValidationRules;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CreateCategory extends ModalComponent
{
    public string $name = '';

    public function mount()
    {
        AppHelper::checkPermission('notes create');
    }

    public function render()
    {
        return view('livewire.notes.control.create-category');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', new CategoryValidationRules()],
        ]);

//        dd($this);
        $category = NotesCategory::create([
            'name' => $this->name,
            'company_id' => Auth::user()->current_company,
            'created_by' => Auth::id(),
        ]);
        $category->save();
        $this->closeModalWithEvents([
            ['setNoteCategory', [$category->id]],
        ]);
    }
}
