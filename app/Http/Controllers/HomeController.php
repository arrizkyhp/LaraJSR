<?php

namespace App\Http\Controllers;

use App\Peralatan;
use App\Pesanan;
use App\Satuan;
use App\Konten;
use App\Penyewaan;
use Illuminate\Http\Request;
use App\ListMakanan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['peralatan'] = Peralatan::all();
        $data['makanan'] = ListMakanan::where('id_jenis_makanan', '!=', '3')->orderBy('id_jenis_makanan', 'ASC')->get();
        $data['snack'] = ListMakanan::where('id_jenis_makanan', '3')->get();
        $data['satuan'] = Satuan::all();
        $data['konten'] = Konten::take(6)->get();

        return view('index', $data);
    }

    public function dashboard()
    {
        $data['pesanan'] = pesanan::where('status_alat', 1)->get();
        $data['penyewaan'] = penyewaan::where('status_alat', 1)->get();


        return view('dashboard', $data);
    }
}