<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;


class PelangganController extends Controller
{

    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required|unique:t_pelanggan'
        ]);

        $pelanggan = new Pelanggan;

        $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
        $pelanggan->alamat = $request->input('alamat');
        $pelanggan->no_telepon = $request->input('no_telepon');

        $pelanggan->save();

        toast('Data Berhasil Ditambahkan!', 'success', 'top-right');
        return redirect()->back();
    }
    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        return response()->json($pelanggan);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);

        $pelanggan = Pelanggan::find($id);


        $pelanggan->nama_pelanggan = $request->input('nama_pelanggan');
        $pelanggan->alamat = $request->input('alamat');
        $pelanggan->no_telepon = $request->input('no_telepon');

        $pelanggan->save();

        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('/admin/pelanggan');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('/admin/pelanggan');
    }
}