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

        // Admin  Only

        Route::get('/dashboard', function () {
            return view('dashboard');
        });

        Route::group(['middleware' => 'admin'], function () {
            // Users
            Route::resource('/users', 'UserController')->except([
                'show'
            ]);

            // Pelanggan
            Route::resource('/pelanggan', 'PelangganController');

            // Pesanan
            Route::resource('/pesanan', 'PesananController');
            Route::get('/list_pesanan', 'PesananController@listPesanan');
            Route::get('/pesanan/detail/{id}', 'PesananController@detailPesanan');
            Route::get('/getDetailPesanan/{id}', 'PesananController@getDetail');
            Route::post('/bayar', 'PesananController@bayar');
            Route::get('/selesai_pesanan/{id}', 'PesananController@selesai');
            // Edit Pesanan
            Route::get('/pesanan/edit/{id}', 'PesananController@edit');

            // Jenis Pesanan
            Route::resource('/jenis_pesanan', 'JenisPesananController');
            Route::get('/jenis_pesanan/{id}/edit', 'JenisPesananController@edit');
            Route::patch('/jenis_pesanan/{id}/edit', 'JenisPesananController@update');

            // Menu
            Route::resource('/menu', 'MenuController');
            Route::get('/menu/getInitialCodeById/{id}', 'MenuController@getInitial')->name('getInitial');
            Route::get('/menu/calculate-harga/{ids}', 'MenuController@calculateHarga');

            // List Makanan/Minuman
            Route::resource('/list_makanan', 'ListMakananController');
            Route::post('/', 'ListMakananController@storeJenis');
            Route::get('/listMakanan/{id}', 'ListMakananController@update');
            Route::delete('/list_makanan/{id}', 'ListMakananController@destroy');
            Route::get('/list_makanan/edit/{id}', 'ListMakananController@editListMakanan');
            Route::get('/getListMakanan/{id}', 'ListMakananController@getListMakanan');

            //  Jenis Makanan
            Route::get('/getJenisMakanan/{id}', 'ListMakananController@getJenisMakanan');
            Route::get('/listJenisMakanan/{id}', 'ListMakananController@updateJenisMakanan');
            Route::delete('/jenis_makanan/{id}', 'ListMakananController@destroyJenisMakanan');

            // Peralatan
            Route::get('/get_peralatan/{id}', 'PenyewaanController@getPeralatan');
        });


        // Manajer Operasional
        Route::group(['middleware' => 'manajer.operasional'], function () {

            // Peralatan
            Route::resource('/peralatan', 'PeralatanController');
            Route::get('/peralatan_rusak', 'PeralatanController@peralatanRusak');
            // Satuan Perlatan
            Route::get('/satuan_tambah', 'PeralatanController@storeSatuan')->name('satuan.store');

            // Pelanggan
            Route::resource('/pelanggan', 'PelangganController');

            // Penyewaan
            Route::resource('/penyewaan', 'PenyewaanController');
            Route::get('/get_peralatan/{id}', 'PenyewaanController@getPeralatan');
            Route::get('/list_penyewaan', 'PenyewaanController@listPenyewaan');
            Route::get('/penyewaan/detail/{id}', 'PenyewaanController@detailPenyewaan');
            Route::get('/penyewaan/edit/{id}', 'PenyewaanController@edit');
            // Pengembalian
            Route::patch('/penyewaan/pengembalian/{id}', 'PenyewaanController@pengembalian')->name('sewa.kembali');
            // PDF
            Route::get('/penyewaan/print/{id}', 'PenyewaanController@printPDF')->name('sewa.print');
        });
    });
});

// Route::get('/home', 'HomeController@index')->name('home');