<?php

namespace App\Http\Livewire\Notes;

use App\Helpers\AppHelper;
use App\Models\NotesCategory;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Note;

class ListAll extends Component
{
    use WithPagination;

    protected $listeners = [
        'updateNotes' => '$refresh',
    ];

    public function render()
    {
        $notes = NotesCategory::where('company_id', Auth::user()->current_company)->with('notes')->get()
            ->pluck('notes')->flatten()->sortBy([
                ['important', 'desc'],
                ['id', 'desc'],
            ]);
//        dd($notes);
        return view('livewire.notes.list-all', [
            'notes' => AppHelper::paginate($notes, 20, 'page'),
        ]);
    }
}

