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
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('teknisi')->group(function () {
        Route::get('/', 'TechnicianController@index')->name('teknisi');
        Route::get('/search-client', 'TechnicianController@searchClient');
        Route::get('/client', 'TechnicianController@client');
        Route::get('/client/search-service', 'TechnicianController@clientService');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', 'TransactionController@index');
        Route::get('/{transaksi_id}', 'TransactionController@show');
        Route::post('/save', 'TransactionController@save');
    });

    Route::prefix('akun')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('/add', 'UserController@add');
        Route::post('/update', 'UserController@update');
        Route::post('/save', 'UserController@save');
    });

    Route::prefix('client')->group(function () {
        Route::get('/', 'ClientController@index');
    });

    // Clear application cache:
    Route::get('/clear-cache', function() {
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        return 'Application cache has been cleared';
    });

    Route::get('/migrate-seeder', function() {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        return 'Application migrate and seeder cleared';
    });
});
