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

// FrontEnd

Route::get('/', function () {
    return view('index');
});

// BackEnd

Auth::routes();
Route::get('/home', 'HomeController@index');



Route::group(['middleware' => 'auth'], function () {
    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        });

        // Users
        Route::resource('/users', 'UserController')->except([
            'show'
        ]);
        Route::get('users/roles/{id}', 'UserController@roles')->name('users.roles');
        // Pelanggan
        Route::resource('/pelanggan', 'PelangganController');
        // Jenis Pesanan
        Route::resource('/jenis_pesanan', 'JenisPesananController');
        Route::get('/jenis_pesanan/{id}/edit', 'JenisPesananController@edit');
        Route::patch('/jenis_pesanan/{id}/edit', 'JenisPesananController@update');
        // Menu
        Route::resource('/menu', 'MenuController');
        Route::get('/menu/getInitialCodeById/{id}', 'MenuController@getInitial')->name('getInitial');
        // List Makanan
        Route::resource('/list_makanan', 'ListMakananController');
        Route::post('/', 'ListMakananController@storeJenis');
        Route::get('/listMakanan/{id}', 'ListMakananController@update');
        Route::get('/listJenisMakanan/{id}', 'ListMakananController@updateJenisMakanan');
        Route::get('/getListMakanan/{id}', 'ListMakananController@getListMakanan');
        Route::get('/getJenisMakanan/{id}', 'ListMakananController@getJenisMakanan');
        // Pesanan
        Route::resource('/pesanan', 'PesananController');
        Route::get('/list_pesanan', 'PesananController@listPesanan');
        Route::get('/pesanan/detail/{id}', 'PesananController@detailPesanan');
        Route::get('/getDetailPesanan/{id}', 'PesananController@getDetail');
        // Route::group(['middleware' => 'superadmin'], function () { });
    });
});

// Route::get('/home', 'HomeController@index')->name('home');