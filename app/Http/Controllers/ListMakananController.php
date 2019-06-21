<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisListMakanan;
use App\ListMakanan;

class ListMakananController extends Controller
{
    public function index()
    {
        $listMakanan = ListMakanan::all();
        $jenisMakanan = JenisListMakanan::all();
        return view('listMakanan.index', compact('listMakanan', 'jenisMakanan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_jenis_makanan' => 'required',
            'nama_makanan' => 'required',

        ]);
        $list_makanan = new ListMakanan;

        $list_makanan->id_jenis_makanan = $request->input('id_jenis_makanan');
        $list_makanan->nama_makanan = $request->input('nama_makanan');

        $list_makanan->save();

        toast('Data Berhasil Ditambahkan!', 'success', 'top-right');
        return redirect()->back();
    }

    public function storeJenis(Request $request)
    {
        $this->validate($request, [
            'nama_jenis_makanan' => 'required',

        ]);

        $jenis_makanan = new JenisListMakanan;

        $jenis_makanan->nama_jenis_makanan = $request->input('nama_jenis_makanan');


        $jenis_makanan->save();

        toast('Data Berhasil Ditambahkan!', 'success', 'top-right');
        return redirect()->back();
    }

    public function getListMakanan($id)
    {
        $listMakanan = ListMakanan::with('jenis_makanan')->find($id);

        return response()->json($listMakanan);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_jenis_makanan' => 'required',
            'nama_makanan' => 'required',
        ]);

        $pelanggan = ListMakanan::find($id);
        $list_makanan->id_jenis_makanan = $request->input('id_jenis_makanan');
        $list_makanan->nama_makanan = $request->input('nama_makanan');

        $pelanggan->save();

        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('/admin/pelanggan');
    }
}