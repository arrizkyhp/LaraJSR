<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\DetailPesanan;
use App\Pelanggan;
use App\Menu;
use Auth;
use DB;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        $menu = Menu::all();
        $pelanggan = Pelanggan::all();

        return view('pesanan.index', compact('pesanan', 'menu', 'pelanggan'));
    }

    public function listPesanan()
    {
        $pesanan = Pesanan::all();
        // $data = DB::table('t_pesanan')->join('t_detail_pesanan', 't_detail_pesanan.id_')
        $detail = DetailPesanan::all();

        return view('pesanan.list.index', compact('pesanan', 'detail'));
    }

    public function detailPesanan($id)
    {

        $pesanan = Pesanan::findOrFail($id);
        $detail = DetailPesanan::where('id_pesanan', '=', $id)->get();
        return view('pesanan.list.detail', compact('pesanan', 'detail'));
    }


    public function getDetail($id)
    {

        $detail_pesanan = DB::table('t_detail_pesanan')->where('id_pesanan', $id)->get();
        return response()->json($detail_pesanan);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'id_pelanggan' => 'required|exists:t_pelanggan,id_pelanggan',
            'nama_menu' => 'required',
            'jenis_pesanan' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'subtotal' => 'required',
            'total_harga' => 'required',
            'bayar' => 'required',
        ]);

        $last_pesanan = Pesanan::orderBy('id_pesanan', 'desc')->first();

        if ($last_pesanan != null) {
            $tests = $last_pesanan->id_pesanan;
        } else {
            $tests = 000;
        }



        $digit = substr($tests, -3);

        $kode = str_pad($digit + 1, 3, 0, STR_PAD_LEFT);


        $inputPesanan['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
        $inputPesanan['id_pelanggan'] = $request->id_pelanggan;
        $inputPesanan['id_users'] = Auth::user()->id_users;
        $inputPesanan['tanggal'] = Carbon::now()->format('Y-m-d');
        // Merubah String ke tanggal
        $time = strtotime($request->tanggal_pesanan);
        $newformat = date('Y-m-d', $time);
        $inputPesanan['tanggal_pesanan'] = $newformat;
        $inputPesanan['total_harga'] = $request->total_harga;
        $inputPesanan['keterangan'] = $request->keterangan;
        $inputPesanan['bayar'] = $request->bayar;
        if ($request->total_harga <= $request->bayar) {
            $inputPesanan['status'] = 0;
        } else {
            $inputPesanan['status'] = 1;
        }

        $pemesanan = Pesanan::create($inputPesanan);
        if ($pemesanan) {
            $inputDetail['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
            foreach ($request->id_menu as $key => $menu_id) {
                $inputDetail['id_menu'] = $menu_id;
                $inputDetail['quantity'] = $request->quantity[$key];
                $inputDetail['harga'] = $request->harga[$key];
                $inputDetail['subtotal'] = $request->subtotal[$key];
                $detail = DetailPesanan::create($inputDetail);
            }
        }

        if ($detail) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect('admin/list_pesanan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }
}