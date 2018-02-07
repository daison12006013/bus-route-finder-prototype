<?php

Route::namespace('Daison\BusRouterSg\Http\Controllers')->middleware(['web'])->prefix(config('bus_router_sg.route_prefix', 'bus-router-sg'))->group(function () {
    # authenticated users
    Route::group(['middleware' => 'auth'], function () {
        Route::get('auth-static-view', 'StaticViewAuthenticated')->name(route_name('static-view-authenticated'));

        Route::any('logout', 'Auth\Logout')->name(route_name('logout'));

        Route::get('buses', 'Buses\Lists')->name(route_name('buses'));
        Route::post('buses', 'Buses\Add')->name(route_name('buses-add-attempt'));
        Route::put('buses', 'Buses\Update')->name(route_name('buses-update-attempt'));
        Route::delete('buses', 'Buses\Delete')->name(route_name('buses-delete'));
    });


    # public api's
    Route::get('/', 'Welcome')->name(route_name('welcome'));
    Route::get('static', 'StaticView')->name(route_name('static-view'));

    Route::group(['middleware' => ['guest']], function () {
        Route::get('login', 'Auth\Login')->name(route_name('login'));
        Route::post('login', 'Auth\LoginAttempt')->name(route_name('login-attempt'));
    });
});
