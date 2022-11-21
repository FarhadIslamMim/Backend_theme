<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\UserController;

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

//Admin all route
Route::middleware(['auth'])->group(function () {
    Route::controller(AdminProfileController::class)->group(function () {

        Route::get('/dashboard', 'Dashboard')->name('dashboard');
        Route::get('profile','index')->name('profile');
        Route::get('/admin/logout', 'logOut')->name('admin.logout');

        Route::post('profile/update', 'updateProfile')->name('profile.update');
        Route::get('profile/password', 'password')->name('profile.password');
        Route::post('profile/password', 'passwordUpdate');

    });
    Route::controller(UserController::class)->group(function () {

        Route::get('users', 'index')->name('users.index');

    });

});
Route::get('/', function () {
    return view('welcome');
});



require __DIR__ . '/auth.php';
