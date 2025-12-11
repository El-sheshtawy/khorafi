<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if(!empty($_COOKIE['lang']) and $_COOKIE['lang'] == 2) {
            $config = DB::table('config')->where("id", 2)->first();        
        } else {
            $config = DB::table('config')->where("id", 1)->first();        
        }
        View::share('config', $config);
    }
}
