<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisPesanan;
use Illuminate\Support\Facades\Storage;

class JenisPesananController extends Controller
{
    public function index()
    {
        $jenis_pesanan = JenisPesanan::all();
        return view('jenispesanan.index', compact('jenis_pesanan'));
    }

    public function show($id)
    {
        $jenis_pesanan = JenisPesanan::find($id);
        return response()->json($jenis_pesanan);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_jenis_pesanan' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|mimes:jpeg,png|max:512'
        ]);


        $input = $request->all();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nama_jenis_pesanan'] . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('', $filename, "upload");
            $input['foto'] = $filename;
        }

        $status = \App\JenisPesanan::create($input);

        alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
        if ($status)  return redirect('/jenis_pesanan');
        else return redirect('/dashboard');
    }


    public function edit($id)
    {
        $data['result'] = \App\JenisPesanan::where('id_jenis_pesanan', $id)->first();
        return view('jenispesanan/edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_jenis_pesanan' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required',
            'foto' => 'mimes:jpeg,png|max:512'
        ]);

        $input = $request->all();
        $result = \App\JenisPesanan::where('id_jenis_pesanan', $id)->first();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nama_jenis_pesanan'] . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('', $filename, "upload");
            $input['foto'] = $filename;
        }

        $status = $result->update($input);

        alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
        if ($status)  return redirect('/admin/jenis_pesanan');
        else return redirect('/dashboard');
    }

    public function destroy($id)
    {
        $pelanggan = JenisPesanan::find($id);
        $pelanggan->delete();

        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('/admin/jenis_pesanan');
    }
}