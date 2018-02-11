<?php

$prefix = config('bus_router_sg.route_prefix', 'bus-prototype');

Route::namespace('Daison\BusRouterSg\Http\Controllers')
    ->middleware(['web'])
    ->prefix($prefix)
    ->group(function () {
        # public routes
        require_once __DIR__.'/routes/public.php';

        # auth routes
        Route::group(['middleware' => [package('auth', 'middleware')]], function () {
            require_once __DIR__.'/routes/auth.php';
        });

        # limited to guest routes
        Route::group(['middleware' => [package('guest', 'middleware')]], function () {
            require_once __DIR__.'/routes/guest.php';
        });
    });
