<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konten;

class KontenController extends Controller
{
    public function index()
    {
        $data['konten'] = Konten::all();
        return view('konten.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_konten' => 'required',
            'deskripsi' => 'required',
            'id_jenis_pesanan' => 'required',
            'foto' => 'required|mimes:jpeg,png|max:512'
        ]);


        $input = $request->all();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nama_konten'] . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('', $filename, "upload");
            $input['foto'] = $filename;
        }

        $status = \App\Konten::create($input);

        alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
        if ($status)  return redirect('/admin/konten');
        else return redirect('/dashboard');
    }
}