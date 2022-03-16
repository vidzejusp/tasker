<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

    public function login(Request $request)
    {
        return view('employee.login');
    }

    public function auth(Request $request)
    {
        $input = $request->validate([
            'passcode' => ['required', 'integer', 'min:1000', 'max:9999'],
        ]);
        $user = Auth::user();
        $employee = Employee::where('user_id', $user->id)->where('passcode', $request->passcode);
        if($employee->count() == 1)
        {
            $employee = $employee->first();
            $user->current_employee = $employee->id;
            $user->save();
            return redirect()->route('dashboard');
        }
        elseif($employee->count() > 1) back()->with('status', 'Įvyko klaida. Prašome pranešti administratoriui');
        else return back()->with('status', 'Neteisingi prisijungimo duomenys');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->current_employee = 0;
        $user->save();
        return redirect()->route('employee.login');
    }

}
