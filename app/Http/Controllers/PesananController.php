<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\DetailPesanan;
use App\ListMakanan;
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
        $listMakanan = ListMakanan::all();

        return view('pesanan.index', compact('pesanan', 'menu', 'pelanggan', 'listMakanan'));
    }

    public function edit($id)
    {
        $menu = Menu::all();
        $pelanggan = Pelanggan::all();
        $listMakanan = ListMakanan::all();
        $detailPesanan = DetailPesanan::where('id_pesanan', '=', $id)->get();
        $pesanan = Pesanan::findOrFail($id);

        return view('pesanan.edit.index', compact('pesanan', 'menu', 'pelanggan', 'listMakanan', 'detailPesanan'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'nama_menu' => 'required',
            'jenis_pesanan' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'subtotal' => 'required',
            'total_harga' => 'required',
            'bayar' => 'required',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->id_pelanggan = $request->input('id_pelanggan');
        $time = strtotime($request->tanggal_pesanan);
        $newformat = date('Y-m-d', $time);
        $pesanan->tanggal_pesanan = $newformat;
        $pesanan->id_pelanggan = $request->input('id_pelanggan');
        $pesanan->total_harga = $request->input('total_harga');
        $pesanan->keterangan = $request->input('keterangan');
        $pesanan->status_pesanan = 1;
        $pesanan->bayar = $request->input('bayar');
        // $inputPesanan['id_users'] = Auth::user()->id_users;
        // $inputPesanan['tanggal'] = Carbon::now()->format('Y-m-d');
        // Merubah String ke tanggal

        if ($request->total_harga <= $request->bayar) {
            $pesanan->status_bayar = 0;
        } else {
            $pesanan->status_bayar = 1;
        }

        $pesanan->save();

        if ($pesanan) {
            // menghapus pesanan yang di delete
            DetailPesanan::where('id_pesanan', $pesanan->id_pesanan)->whereNotIn('id_menu', $request->id_menu)->delete();

            $inputDetail['id_pesanan'] = $pesanan->id_pesanan;
            foreach ($request->id_menu as $key => $menu_id) {
                $inputDetail['id_menu'] = $menu_id;
                $inputNom['quantity'] = $request->quantity[$key];
                $inputNom['harga'] = $request->harga[$key];
                $inputNom['subtotal'] = $request->subtotal[$key];
                $detail = DetailPesanan::updateOrCreate($inputDetail, $inputNom);
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
        $inputPesanan['status_pesanan'] = 1;
        $inputPesanan['bayar'] = $request->bayar;
        if ($request->total_harga <= $request->bayar) {
            $inputPesanan['status_bayar'] = 0;
        } else {
            $inputPesanan['status_bayar'] = 1;
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

    public function bayar(Request $request)
    {
        $pesanan = Pesanan::find($request->id_pesanan);

        $pesanan->bayar = $pesanan->bayar + $request->bayar_lagi;

        if ($pesanan->bayar >= $pesanan->total_harga) {
            $pesanan->status_bayar = 0;
        } else {
            $pesanan->status_bayar = 1;
        }

        $status = $pesanan->save();
        if ($status) {
            alert()->success('Berhasil', 'Data Berhasil diubah')->persistent('Close');
            return redirect()->back();
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function selesai($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->status_pesanan = 0;
        $status = $pesanan->save();
        if ($status) {
            alert()->success('Berhasil', 'Pesanan Selesai')->persistent('Close');
            return redirect('admin/list_pesanan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $pelanggan = Pesanan::find($id);
        DetailPesanan::where('id_pesanan', '=', $id)->get()->each->delete();
        $pelanggan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('admin/list_pesanan');
    }
}