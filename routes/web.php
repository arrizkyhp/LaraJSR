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

        // Pelanggan
        Route::resource('/pelanggan', 'PelangganController');

        // Jenis Pesanan
        Route::resource('/jenis_pesanan', 'JenisPesananController');
        Route::get('/jenis_pesanan/{id}/edit', 'JenisPesananController@edit');
        Route::patch('/jenis_pesanan/{id}/edit', 'JenisPesananController@update');

        // Menu
        Route::resource('/menu', 'MenuController');
        Route::get('/menu/getInitialCodeById/{id}', 'MenuController@getInitial')->name('getInitial');

        // List Makanan/Minuman
        Route::resource('/list_makanan', 'ListMakananController');
        Route::post('/', 'ListMakananController@storeJenis');
        Route::get('/listMakanan/{id}', 'ListMakananController@update');
        Route::delete('/list_makanan/{id}', 'ListMakananController@destroy');
        Route::get('/getListMakanan/{id}', 'ListMakananController@getListMakanan');

        //  Jenis Makanan
        Route::get('/getJenisMakanan/{id}', 'ListMakananController@getJenisMakanan');
        Route::get('/listJenisMakanan/{id}', 'ListMakananController@updateJenisMakanan');
        Route::delete('/jenis_makanan/{id}', 'ListMakananController@destroyJenisMakanan');

        // Pesanan
        Route::resource('/pesanan', 'PesananController');
        Route::get('/list_pesanan', 'PesananController@listPesanan');
        Route::get('/pesanan/detail/{id}', 'PesananController@detailPesanan');
        Route::get('/getDetailPesanan/{id}', 'PesananController@getDetail');
        Route::post('/bayar', 'PesananController@bayar');
        Route::get('/selesai_pesanan/{id}', 'PesananController@selesai');
        // Edit Pesanan
        Route::get('/pesanan/edit/{id}', 'PesananController@edit');

        // Peralatan
        Route::resource('/peralatan', 'PeralatanController');

        // Penyewaan
        Route::resource('/penyewaan', 'PenyewaanController');
        Route::get('/get_peralatan/{id}', 'PenyewaanController@getPeralatan');

        // Route::group(['middleware' => 'superadmin'], function () { });
    });
});

// Route::get('/home', 'HomeController@index')->name('home');