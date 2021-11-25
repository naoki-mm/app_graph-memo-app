<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::namespace('Graph')->group(function () {
        Route::resource('graph', 'GraphController', ['expect' => ['show']]);
        Route::post('graph-image-save', 'GraphImageSaveController')->name('graph.image.save');
        Route::put('favorite-update/{graph}', 'FavoriteUpdateController')->name('favorite.update');
    });
    Route::namespace('User')->group(function () {
        Route::resource('user-profile', 'ProfileChangeController', ['only' => ['edit', 'update']]);
        Route::resource('user-email', 'EmailChangeController', ['only' => ['edit', 'update']]);
        Route::resource('user-password', 'PasswordChangeController', ['only' => ['edit', 'update']]);
    });
});
