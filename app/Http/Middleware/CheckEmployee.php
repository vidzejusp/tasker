<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $condition)
    {
        //dd($condition);
        if(Auth::user()->HasEmployees() && Auth::user()->current_employee == 0)
        {
            if ($condition == 'true') return redirect()->route('employee.login');
            else return $next($request);
        }
        else if($condition == 'false') return redirect()->route('dashboard');
        return $next($request);
    }
}
