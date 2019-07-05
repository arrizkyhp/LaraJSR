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

// Route::get('/', function () {
//     return view('index');
// });

// BackEnd

Auth::routes();
Route::get('/', 'HomeController@index');



Route::group(['middleware' => 'auth'], function () {


    Route::prefix('admin')->group(function () {


        // Grey Area
        Route::get('/dashboard', function () {
            return view('dashboard');
        });




        // Admin  Only

        Route::group(['middleware' => 'admin'], function () {
            // Users
            Route::resource('/users', 'UserController')->except([
                'show'
            ]);
            // Pesanan
            Route::resource('/pesanan', 'PesananController')->except([
                'show'
            ]);
            Route::get('/list_pesanan', 'PesananController@listPesanan');
            Route::get('/pesanan/detail/{id}', 'PesananController@detailPesanan');
            Route::get('/getDetailPesanan/{id}', 'PesananController@getDetail');
            Route::post('/bayar', 'PesananController@bayar');
            Route::get('/selesai_pesanan/{id}', 'PesananController@selesai');
            // Edit Pesanan
            Route::get('/pesanan/edit/{id}', 'PesananController@edit');
            // Laporan
            Route::get('/laporan_pesanan', 'PesananController@listPesananLaporan')->name('pesanan.laporan');
            // PDF
            Route::get('/pesanan/print/{id}', 'PesananController@printPDF')->name('pesanan.print');
            Route::get('/pesanan/pdf', 'PesananController@laporan')->name('pesanan.laporanPrint');

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

            // Konten
            Route::resource('/konten', 'KontenController')->except([
                'show'
            ]);
        });

        // Pelanggan
        Route::resource('/pelanggan', 'PelangganController');
        // get Peralatan
        Route::get('/get_peralatan/{id}', 'PenyewaanController@getPeralatan');



        // Manajer Operasional
        Route::group(['middleware' => 'manajer.operasional'], function () {

            // Peralatan
            Route::resource('/peralatan', 'PeralatanController');
            Route::get('/peralatan_rusak', 'PeralatanController@peralatanRusak');
            // Satuan Perlatan
            Route::get('/satuan_tambah', 'PeralatanController@storeSatuan')->name('satuan.store');
            // Stock
            Route::get('/Stock/{id}', 'PeralatanController@Stock')->name('stock.peralatan');
            Route::get('/get_stock/{id}', 'PeralatanController@getStock')->name('stock.get');
            Route::get('/stockUpdate/{id}', 'PeralatanController@EditStock')->name('stock.update');
            // PDF
            Route::get('/stock/print/{id}', 'PeralatanController@printPDF')->name('stock.print');

            // Penyewaan
            Route::resource('/penyewaan', 'PenyewaanController');
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