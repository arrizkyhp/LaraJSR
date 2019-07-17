<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konten;
use Illuminate\Support\Facades\Validator;

class KontenController extends Controller
{
    public function index()
    {

        return view('konten.index');
    }

    public function listMenu()
    {
        $data['konten'] = Konten::all();
        return view('konten.menuKonten', $data);
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

    public function edit($id)
    {
        $data['menuKonten'] = Konten::findOrFail($id);

        return view('konten.edit.menu', $data);
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama_konten' => 'required',
            'id_jenis_pesanan' => 'required',
            'foto' => 'mimes:jpeg,png|max:512'
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal', 'Data Gagal Diubah')->persistent('Close');
            return back();
        }

        $input = $request->all();

        $result = \App\Konten::where('id_konten', $id)->first();

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $filename = $input['nama_konten'] . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('', $filename, "upload");
            $input['foto'] = $filename;
        }

        $status = $result->update($input);

        alert()->success('Berhasil', 'Data Berhasil diubah')->persistent('Close');
        if ($status)  return back();
        else return redirect('/dashboard');
    }
}