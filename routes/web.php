<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'lang'], function () {

    Route::get("/", "Home@index");

    Route::get("/login", "AuthController@login");
    Route::post("/login", "AuthController@DoLogin");

    Route::get("/posts", "Home@posts");
    Route::get("/post/{id}", "Home@post");
    Route::get("/opinions", "Home@opinions");
    Route::get("/results", "Home@results");
    Route::get("/gallery", "Home@gallery");
    Route::get("/locations", "Home@locations");
    Route::get("/subscription", "Home@subscription");
    Route::get("/subscription/get/{id}", "Home@GetSubscription");
    Route::get("/subscription/get/regions/{id}", "Home@GetRegions");
    Route::post("/subscription/user", "Home@UserSubscription");
    Route::post("/subscription/register", "Home@RegisterSubscription");

    Route::get("/contact", "Home@contact");
    Route::post("/contact", "Home@DoContact");
});

Route::get('/admin/subscriptions/print', 'Admin\\Subscriptions@printSchedule');
Route::get('/admin/subscriptions/print2', 'Admin\\Subscriptions@printSchedule2');
Route::get('/admin/subscriptions/stats', 'Admin\\Subscriptions@stats');
