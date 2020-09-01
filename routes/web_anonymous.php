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

Route::group(
    [
        'as' => 'anonymous.',
        'namespace' => 'Anonymous',
    ],
    function () {
        Route::get('sitemap.xml', ['as' => 'sitemap', 'uses' => 'SitemapController@index']);
        Route::group(['namespace' => 'Files'], function () {
            Route::get('files/media/{hash}', ['as' => 'files.media', 'uses' => 'MediasController@media']);
            Route::get('files/document/{path}', [
                'as' => 'files.document',
                'uses' => 'FilesController@document'
            ])->where('path', '.+');
            Route::get('files/thumbnail/{path}', [
                'as' => 'files.thumbnail',
                'uses' => 'FilesController@thumbnail'
            ])->where('path', '.+');
        });
        Route::group(['namespace' => 'Users'], function () {
            Route::get('/', ['as' => 'dashboard', 'uses' => 'UsersController@dashboard'])->middleware('guest');
            Route::get('subscribe/{plan}', ['as' => 'subscribe', 'uses' => 'CreateSubscriptionController']);
            Route::get('trainer/{user}', ['as' => 'trainer', 'uses' => 'UsersController@show']);
            Route::get('terms-of-services', ['as' => 'terms', 'uses' => 'UsersController@terms']);
            Route::get('streamfeed', ['as' => 'streamfeed', 'uses' => 'UsersController@stream']);
            Route::model('trainer', \pkmnfriends\Domain\Users\Users\User::class);
            Route::resource('trainers', 'UsersController')->only(['index', 'show']);
        });
    }
);
