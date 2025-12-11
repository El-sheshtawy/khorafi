<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Closure;
use App;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null)
    {
        if (empty($_COOKIE['lang'])) {
            setcookie("lang", 1, time() + (86400 * 30), "/");
            App::setLocale('ar');
        }

        if (request('lang') == 2) {
            setcookie("lang", 2, time() + (86400 * 30), "/");
            App::setLocale('en');
            return back();
        }

        if (request('lang') == 1) {
            setcookie("lang", 1, time() + (86400 * 30), "/");
            App::setLocale('ar');
            return back();
        }

        if (isset($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
            App::setLocale('en');
        }

        return $next($request);
    }
}
