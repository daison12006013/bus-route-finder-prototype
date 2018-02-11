<?php

Route::get('login', 'Auth\Login')->name(package('login'));
Route::post('login', 'Auth\LoginAttempt')->name(package('login-attempt'));
