<?php

use Illuminate\Support\Facades\Route;

Route::get('/status/{token}', 'GuardInfoController@index');
