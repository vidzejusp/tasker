<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $name;

    public function render()
    {
        $roles = Role::all();
        return view('livewire.roles', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'unique:roles'],
        ]);
        $role = Role::create([
            'name' => $this->name,
        ]);
        $this->render();
    }
}
