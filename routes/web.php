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
        Route::get('/client/{client_id}', 'TechnicianController@client');
        Route::get('/client/{client_id}/{service_id}', 'TechnicianController@clientService');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', 'TransactionController@index');
        Route::get('/{transaksi_id}', 'TransactionController@show');
        Route::post('/save', 'TransactionController@save');
    });



});
