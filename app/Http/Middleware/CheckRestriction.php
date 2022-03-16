<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->allowed_ips === '' || Auth::user()->allowed_ips === null) {
            return $next($request);
        }
        else {
            $allowed_ips = explode(',', Auth::user()->allowed_ips);
            if(in_array($request->ip(), $allowed_ips)) return $next($request);
            else {
                Auth::logout();
                return abort(403);
//                return redirect()->route('login')->with('error', 'Neleidžiamas veiksmas!');
            }
        }
    }
}
