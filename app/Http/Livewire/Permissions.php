<?php

namespace App\Http\Livewire;

use App\Rules\UserValidationRules;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{

    public $name;

    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.permissions', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'unique:permissions'],
        ]);
        $role = Permission::create([
            'name' => $this->name,
        ]);
        $this->render();
    }
}
