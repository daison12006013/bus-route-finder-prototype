<?php

# public api's
Route::get('/', 'Welcome')->name(package('welcome'));
Route::get('static', 'StaticView')->name(package('static-view'));
