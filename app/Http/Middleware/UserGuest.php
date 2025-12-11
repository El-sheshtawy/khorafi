<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;
use Str;

class UserGuest
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
        if (empty($_COOKIE['user_guest']) and !Auth::guard($guard)->check()) {
            setcookie('user_guest', Str::Random(40), time() + 60 * 60 * 24 * 30 * 12, '/');
            return redirect('/');
        }

        return $next($request);
    }
}
