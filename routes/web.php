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

Route::get('/not-found', 'HelperController@notFound');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::prefix('teknisi')->group(function () {
        Route::get('/', 'TechnicianController@index')->name('teknisi');
        Route::get('/search-client', 'TechnicianController@searchClient');
        Route::get('/service', 'TechnicianController@service');
        Route::get('/service/edit/{transaksi_detail_id}', 'TechnicianController@serviceEdit');
        Route::get('/client', 'TechnicianController@client');
        Route::get('/client/search-service', 'TechnicianController@clientService');
    });

    Route::prefix('transaksi')->group(function () {
        Route::get('/', 'TransactionController@index');
        Route::get('/{transaksi_id}', 'TransactionController@show');
        Route::post('/update/{transaksi_id}', 'TransactionController@update');
        Route::post('/remove/{transaksi_id}', 'TransactionController@destroy');
        Route::post('/save', 'TransactionController@saveWithDetail');
    });

    Route::prefix('transaksi-detail')->group(function () {
        Route::post('/remove/{transaksi_detail_id}/', 'TransactionDetailController@destroy');
        Route::post('/update/{transaksi_detail_id}', 'TransactionDetailController@update');
    });

    Route::prefix('akun')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('/add', 'UserController@add');
        Route::post('/update', 'UserController@update');
        Route::post('/save', 'UserController@save');

        Route::middleware('user-admin')->group(function() {
            Route::get('/detail/{user_id}', 'UserController@detail');
            Route::get('/load-more', 'UserController@loadMore');
            Route::get('/remove', 'UserController@remove');
            Route::get('/teknisi', 'UserController@index');
            Route::get('/client', 'UserController@index');
        });
    });

    Route::prefix('client')->group(function () {
        Route::get('/', 'ClientController@index');
    });

    // upload images
    Route::post('/tmp-upload', 'UploadController@trxImageUpload');
    Route::post('/tmp-delete', 'UploadController@trxImageDelete');

    Route::middleware('user-admin')->group(function() {
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
});
