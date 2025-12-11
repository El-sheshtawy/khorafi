<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Closure;

class Rols
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
        $promotion = DB::table("rols")->where([['user_id', auth()->guard("admin")->user()->id]])->first();
        if ($promotion->$guard == 1 or auth()->guard('admin')->user()->id == 1) {
            return $next($request);
        } else {
            return back()->with("error", "أنت لا تمتلك الصلاحية.");
        }
    }
}
