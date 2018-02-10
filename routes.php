<?php

$prefix = config('bus_router_sg.route_prefix', 'bus-prototype');

Route::namespace('Daison\BusRouterSg\Http\Controllers')->middleware(['web'])->prefix($prefix)->group(function () {
    # authenticated users
    Route::group(['middleware' => 'auth'], function () {
        Route::any('logout', 'Auth\Logout')->name(package('logout'));

        Route::get('buses', 'Buses\Lists')->name(package('buses'));
        Route::post('buses', 'Buses\Add')->name(package('buses-add-attempt'));
        Route::put('buses', 'Buses\Update')->name(package('buses-update-attempt'));
        Route::delete('buses', 'Buses\Delete')->name(package('buses-delete'));
    });

    # public api's
    Route::get('/', 'Welcome')->name(package('welcome'));
    Route::get('static', 'StaticView')->name(package('static-view'));

    Route::group(['middleware' => ['guest']], function () {
        Route::get('login', 'Auth\Login')->name(package('login'));
        Route::post('login', 'Auth\LoginAttempt')->name(package('login-attempt'));
    });
});
