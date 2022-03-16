<?php

namespace App\Http\Livewire\ControlPanel;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Relation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;
use App\Rules\UserValidationRules;
use Spatie\Permission\Models\Role;

class Users extends Component
{

    public $name; public $username; public $password; public $role;

    public $listeners = [ 'updateUsers' => 'render'];

    public function mount()
    {
        $this->role = 'employee';
    }

    public function render()
    {
        $company = Auth::user()->company;
        $users = $company->users;
        $company_roles = Role::where('name', 'not like', "%global_%")->pluck('name');
        //dd($users);
        return view('livewire.control-panel.users.list-all', [
            'users' => $users,
            'roles' => $company_roles,
        ]);
    }

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', new UserValidationRules()],
            'username' => ['required', 'string', new UserValidationRules()],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string'],
        ]);

        $user = User::create([
           'name' => $this->name,
           'username' => $this->username,
           'password' => Hash::make($this->password),
           'current_company' => Auth::user()->current_company,
            'current_employee' => 0,
        ]);

        $relation = Relation::create([
            'user_id' =>  $user->id,
            'company_id' => Auth::user()->current_company,
            'role' => $this->role,
        ]);

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>'Pavyko',
        ]);
        $this->emit('updateUsers');
    }
}
