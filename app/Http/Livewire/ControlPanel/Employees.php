<?php

namespace App\Http\Livewire\ControlPanel;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;
use App\Rules\UserValidationRules;

class Employees extends Component
{

    public $name; public $user_id;

    public $listeners = [ 'updateUsers' => 'render'];

    public function mount()
    {
        $this->user_id = Auth::user()->company->users->first()->id;
    }

    public function render()
    {
        $company = Auth::user()->company;
        $users = $company->users;
        return view('livewire.control-panel.employees.list-all', [
            'users' => $users,
        ]);
    }

    public function create()
    {

        $this->validate([
            'name' => ['required', 'string', Rule::unique('employees')->where(function ($query) {
                return $query->where('user_id', $this->user_id);})],
            'user_id' => ['required', 'integer'],
        ]);

        $passcode = random_int('1000', '9999');
        while (Employee::where('user_id', $this->user_id)->where('passcode', $passcode)->exists()) $passcode = random_int('1000', '9999');

        $employee = Employee::create([
            'name' => $this->name,
            'user_id' => $this->user_id,
            'passcode' => $passcode,
        ]);

        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>'Pavyko',
        ]);
        $this->render();

    }
}
