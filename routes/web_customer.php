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
        'as' => 'customer.',
        'namespace' => 'Customer',
        'domain' => env('APP_DOMAIN'),
        'middleware' => ['auth', 'role:'.\obsession\Domain\Users\Users\User::ROLE_CUSTOMER],
    ],
    function () {

        Route::resource('dashboard', 'DashboardController');

    });