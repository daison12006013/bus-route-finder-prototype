<?php

Route::any('logout', 'Auth\Logout')->name(package('logout'));

Route::get('buses', 'Buses\Lists')->name(package('buses'));
Route::post('buses', 'Buses\Add')->name(package('buses-add-attempt'));
Route::put('buses', 'Buses\Update')->name(package('buses-update-attempt'));
Route::delete('buses', 'Buses\Delete')->name(package('buses-delete'));

Route::get('bus-stops', 'BusStops\Lists')->name(package('bus-stops'));
Route::post('bus-stops', 'BusStops\Add')->name(package('bus-stops-add-attempt'));
Route::put('bus-stops', 'BusStops\Update')->name(package('bus-stops-update-attempt'));
Route::delete('bus-stops', 'BusStops\Delete')->name(package('bus-stops-delete'));
