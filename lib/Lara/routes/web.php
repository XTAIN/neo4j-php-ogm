<?php

use Illuminate\Support\Facades\Route;

Route::get('/status/{token}', 'GuardInfoController@index');
Route::get('/clear-cache-smart/{token}', 'ClearCacheController@clearSmart');
