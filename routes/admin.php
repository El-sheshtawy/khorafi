<?php

Route::group(["prefix" => "admin", "namespace" => 'Admin'], function () {
    Config::set('auth.defines', "admin");

    //This Routes For LogIn
    Route::get("/login", "Users@login");
    Route::post("/login", "Users@doLogin");


    Route::group(['middleware' => 'admin:admin'], function () {

        //This Route For Log Out
        Route::get("/logout", "Users@logout");

        //This routes For Home
        Route::get("/", "Home@index");
        //Route::get("/home/excel", "Home@excel");
        Route::get("/home/pdf", "Home@pdf");

        Route::get("/deny", function () {
            return view("admin.pages.deny");
        });

        //This Route For Edit Profile Data
        Route::get("/profile", "Users@profile");
        Route::post("/profile", "Users@updateProfile");



        Route::get("/users", "Users@index");
        Route::get("/users/show/{id}", "Users@show");
        Route::get("/users/deny/{id}", "Users@deny");
        Route::post("/users/deny/{id}", "Users@DoDeny");
        Route::get("/users/add", "Users@add");
        Route::post("/users/add", "Users@insert");
        Route::get("/users/edit/{id}", "Users@edit");
        Route::post("/users/edit/{id}", "Users@update");
        Route::get("/users/delete/{id}", "Users@delete");
        Route::post("/users/update-subscription-number", "Users@updateSubscriptionNumber");

        Route::get("/sliders", "Sliders@index");
        Route::get("/sliders/add", "Sliders@add");
        Route::post("/sliders/add", "Sliders@insert");
        Route::get("/sliders/edit/{id}", "Sliders@edit");
        Route::post("/sliders/edit/{id}", "Sliders@update");
        Route::get("/sliders/delete/{id}", "Sliders@delete");

        Route::get("/posts", "Posts@index");
        Route::get("/posts/add", "Posts@add");
        Route::post("/posts/add", "Posts@insert");
        Route::get("/posts/edit/{id}", "Posts@edit");
        Route::post("/posts/edit/{id}", "Posts@update");
        Route::get("/posts/delete/{id}", "Posts@delete");

        Route::get("/locations", "Locations@index");
        Route::get("/locations/add", "Locations@add");
        Route::post("/locations/add", "Locations@insert");
        Route::get("/locations/edit/{id}", "Locations@edit");
        Route::post("/locations/edit/{id}", "Locations@update");
        Route::get("/locations/delete/{id}", "Locations@delete");

        Route::get("/gallery", "GalleryController@index");
        Route::get("/gallery/add", "GalleryController@add");
        Route::post("/gallery/add", "GalleryController@insert");
        Route::get("/gallery/edit/{id}", "GalleryController@edit");
        Route::post("/gallery/edit/{id}", "GalleryController@update");
        Route::get("/gallery/delete/{id}", "GalleryController@delete");

        Route::get("/events", "EventController@index");
        Route::get("/events/add", "EventController@add");
        Route::post("/events/add", "EventController@insert");
        Route::get("/events/edit/{id}", "EventController@edit");
        Route::post("/events/edit/{id}", "EventController@update");
        Route::get("/events/delete/{id}", "EventController@delete");

        Route::get("/nationalities", "Nationalities@index");
        Route::get("/nationalities/add", "Nationalities@add");
        Route::post("/nationalities/add", "Nationalities@insert");
        Route::get("/nationalities/edit/{id}", "Nationalities@edit");
        Route::post("/nationalities/edit/{id}", "Nationalities@update");
        Route::get("/nationalities/delete/{id}", "Nationalities@delete");

        Route::get("/cities", "Cities@index");
        Route::get("/cities/add", "Cities@add");
        Route::post("/cities/add", "Cities@insert");
        Route::get("/cities/edit/{id}", "Cities@edit");
        Route::post("/cities/edit/{id}", "Cities@update");
        Route::get("/cities/delete/{id}", "Cities@delete");

        Route::get("/regions", "Regions@index");
        Route::get("/regions/add", "Regions@add");
        Route::post("/regions/add", "Regions@insert");
        Route::get("/regions/edit/{id}", "Regions@edit");
        Route::post("/regions/edit/{id}", "Regions@update");
        Route::get("/regions/delete/{id}", "Regions@delete");

        Route::get("/subscriptionsnames", "SubscriptionsNames@index");
        Route::get("/subscriptionsnames/edit/{id}", "SubscriptionsNames@edit");
        Route::post("/subscriptionsnames/edit/{id}", "SubscriptionsNames@update");

        Route::get("/subscriptions", "Subscriptions@index");
        Route::get("/subscriptions/edit/{id}", "Subscriptions@edit");
        Route::post("/subscriptions/edit/{id}", "Subscriptions@update");
        Route::get("/subscriptions/excel/export", "Subscriptions@ExportExcel");
        Route::get("/subscriptions/excel/import", "Subscriptions@ImportExcel");
        Route::post("/subscriptions/excel/import", "Subscriptions@DoImportExcel");
        Route::get("/subscriptions/get/{id}", "Subscriptions@GetSubscription");
        Route::get('/subscriptions/fetch', "Subscriptions@fetchSubscriptions");
        Route::delete('/subscriptions/delete/{id}', "Subscriptions@deleteSubscription");
        Route::post('/subscriptions/delete-selected/{ids}', "Subscriptions@deleteSubscriptiontotal");
        
        // Participation date assignment routes
        Route::post('/subscriptions/assign-date-all', "Subscriptions@assignDateToAll");
        Route::post('/subscriptions/assign-date-multiple', "Subscriptions@assignDateToMultiple");
        Route::post('/subscriptions/assign-date-single/{id}', "Subscriptions@assignDateToSingle");
        Route::get("/contact", "ContactController@index");
        Route::get("/contact/reply/{id}", "ContactController@reply");
        Route::post("/contact/reply/{id}", "ContactController@update");

        Route::get("/config", "Config@index");
        Route::get("/config/edit/{id}", "Config@edit");
        Route::post("/config/edit/{id}", "Config@update");
    });
});
