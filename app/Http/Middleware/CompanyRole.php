<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->currentRole() !== $role) {
            return abort('403');
        }
        return $next($request);
    }
}
