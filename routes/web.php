<?php

use Illuminate\Support\Facades\Route;

//Test Route::START
Route::group(['prefix' => 'command'], function () {
    Route::get('clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        dd("All clear!");
    });

    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
        dd("Added!");
    });
});
//Test Route::END


Route::get('/', function () {
    return view('welcome');
});
