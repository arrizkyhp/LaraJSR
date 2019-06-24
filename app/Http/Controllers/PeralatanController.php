<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peralatan;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatan = Peralatan::all();
        return view('peralatan.index', compact('peralatan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_peralatan' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'harga_sewa' => 'required',
            'harga_ganti' => 'required'
        ]);

        $peralatan = new Peralatan;

        $peralatan->nama_peralatan = $request->input('nama_peralatan');
        $peralatan->satuan = $request->input('satuan');
        $peralatan->stock = $request->input('stock');
        $peralatan->harga_sewa = $request->input('harga_sewa');
        $peralatan->harga_ganti = $request->input('harga_ganti');

        $peralatan->save();

        toast('Data Berhasil Ditambahkan!', 'success', 'top-right');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_peralatan' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'harga_sewa' => 'required',
            'harga_ganti' => 'required'
        ]);

        $peralatan = Peralatan::find($id);

        $peralatan->nama_peralatan = $request->input('nama_peralatan');
        $peralatan->satuan = $request->input('satuan');
        $peralatan->stock = $request->input('stock');
        $peralatan->harga_sewa = $request->input('harga_sewa');
        $peralatan->harga_ganti = $request->input('harga_ganti');
        $peralatan->save();

        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('/admin/peralatan');
    }

    public function destroy($id)
    {
        $peralatan = Peralatan::find($id);
        $peralatan->delete();

        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('/admin/peralatan');
    }
}