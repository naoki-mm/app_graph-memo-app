<?php

Auth::routes();

Route::get('guest-login', 'Auth\LoginController@guestLogin')->name('guest.login');

Route::middleware(['guest'])->group(function () {
    Route::namespace('Top')->group(function () {
        Route::get('/', 'TopPageController@showTop')->name('top.show');
        Route::get('user-policy', 'TopPageController@showUserPolicy')->name('user_policy.show');
        Route::get('privacy-policy', 'TopPageController@showPrivacyPolicy')->name('privacy_policy.show');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::namespace('Graph')->group(function () {

        Route::resource('graph', 'GraphController', ['except' => ['show']]);

        Route::prefix('image-save')->group(function () {
            Route::post('graph', 'ImageSaveController@saveGraphImage')->name('graph.image.save');
            Route::post('plot', 'ImageSaveController@savePlotImage')->name('plot.image.save');
        });

        Route::put('favorite-update/{graph}', 'FavoriteUpdateController')->name('favorite.update');

        Route::prefix('trash')->group(function () {
            Route::get('/', 'TrashController@index')->name('trash.index');
            Route::put('restore/{id}', 'TrashController@restore')->name('trash.restore');
            Route::delete('destroy/{id}', 'TrashController@destroy')->name('trash.destroy');
        });

        Route::prefix('search')->group(function () {
            Route::get('tags/{name}', 'SearchController@tagSearch')->name('tag.search');
            Route::get('favorite', 'SearchController@favoriteSearch')->name('favorite.search');
            Route::get('sort/{order}', 'SearchController@sort')->name('index.sort');
            Route::get('keyword', 'SearchController@keywordSearch')->name('keyword.search');
        });

        Route::get('download-csv/{graph}', 'DownloadCsvController')->name('csv.download');
    });

    Route::namespace('User')->group(function () {
        Route::resource('user-profile', 'ProfileChangeController', ['only' => ['edit', 'update']]);
        Route::resource('user-email', 'EmailChangeController', ['only' => ['edit', 'update']]);
        Route::resource('user-password', 'PasswordChangeController', ['only' => ['edit', 'update']]);
        Route::resource('delete-account', 'DeleteAccountController', ['only' => ['edit', 'destroy']]);
    });
});
