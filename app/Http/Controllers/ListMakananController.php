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

    public function getJenisMakanan($id)
    {
        $jenisMakanan = JenisListMakanan::find($id);

        return response()->json($jenisMakanan);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_jenis_makanan' => 'required',
            'nama_makanan' => 'required',
        ]);

        $list_makanan = ListMakanan::find($id);
        $list_makanan->id_jenis_makanan = $request->input('id_jenis_makanan');
        $list_makanan->nama_makanan = $request->input('nama_makanan');

        $list_makanan->save();

        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('/admin/list_makanan');
    }

    public function destroy($id)
    {
        $pelanggan = ListMakanan::find($id);
        $pelanggan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('/admin/list_makanan');
    }

    public function updateJenisMakanan(Request $request, $id)
    {
        $this->validate($request, [
            'nama_jenis_makanan' => 'required',
        ]);

        $list_makanan = JenisListMakanan::find($id);
        $list_makanan->nama_jenis_makanan = $request->input('nama_jenis_makanan');

        $list_makanan->save();

        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('/admin/list_makanan');
    }

    public function destroyJenisMakanan($id)
    {
        $pelanggan = JenisListMakanan::find($id);
        $pelanggan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('/admin/list_makanan');
    }
}