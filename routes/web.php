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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/teknisi', 'TechnicianController@index')->name('teknisi');
    Route::get('/teknisi/search-client', 'TechnicianController@searchClient');
    Route::get('/teknisi/client/{client_id}', 'TechnicianController@client');
    Route::get('/teknisi/client/{client_id}/{service_id}', 'TechnicianController@clientService');

    Route::get('/transaksi', 'TransactionController@index');
    Route::get('/transaksi/{transaksi_id}', 'TransactionController@show');
    Route::post('/transaksi/save', 'TransactionController@save');
});
