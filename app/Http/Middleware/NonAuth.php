<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class NonAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return $next($request);
        } else {
            return redirect('/profile/' . auth()->guard($guard)->user()->id);
        }
    }
}
