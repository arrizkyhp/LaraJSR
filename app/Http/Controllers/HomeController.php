<?php

namespace App\Http\Controllers;

use App\Peralatan;
use App\Satuan;
use App\Konten;
use Illuminate\Http\Request;

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
        $data['satuan'] = Satuan::all();
        $data['konten'] = Konten::take(6)->get();

        return view('index', $data);
    }
}