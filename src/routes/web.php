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
            // 画像の一時保持
            Route::post('graph', 'ImageSaveController@saveGraphImage')->name('graph.image.save');
            // プロットデータの画像保存
            Route::post('plot', 'ImageSaveController@savePlotImage')->name('plot.image.save');
        });

        // お気に入りフラグの変更
        Route::put('favorite-update/{graph}', 'FavoriteUpdateController')->name('favorite.update');

        Route::prefix('trash')->group(function () {
            // ゴミ箱の中身を表示
            Route::get('/', 'TrashController@index')->name('trash.index');
            // ゴミ箱のデータを復元
            Route::put('restore/{id}', 'TrashController@restore')->name('trash.restore');
            // ゴミ箱のデータを完全削除
            Route::delete('destroy/{id}', 'TrashController@destroy')->name('trash.destroy');
        });

        Route::prefix('search')->group(function () {
            // タグ絞り込み
            Route::get('tags/{name}', 'SearchController@tagSearch')->name('tag.search');
            // お気に入り絞り込み
            Route::get('favorite', 'SearchController@favoriteSearch')->name('favorite.search');
            // ソート機能
            Route::get('sort/{order}', 'SearchController@sort')->name('index.sort');
            // キーワード検索
            Route::get('keyword', 'SearchController@keywordSearch')->name('keyword.search');
        });

        // CSVダウンロード
        Route::get('download-csv/{graph}', 'DownloadCsvController')->name('csv.download');
    });

    Route::namespace('User')->group(function () {
        Route::resource('user-profile', 'ProfileChangeController', ['only' => ['edit', 'update']]);
        Route::resource('user-email', 'EmailChangeController', ['only' => ['edit', 'update']]);
        Route::resource('user-password', 'PasswordChangeController', ['only' => ['edit', 'update']]);
        Route::resource('delete-account', 'DeleteAccountController', ['only' => ['edit', 'destroy']]);
    });
});
