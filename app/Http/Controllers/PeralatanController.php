<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peralatan;
use App\Satuan;
use App\Stock;
use App\PeralatanRusak;
use PDF;

class PeralatanController extends Controller
{
    public function index()
    {
        $data['peralatan'] = Peralatan::all();

        $data['satuan'] = Satuan::all();

        return view('peralatan.index', $data);
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
        $peralatan->id_satuan = $request->input('satuan');
        $peralatan->harga_sewa = $request->input('harga_sewa');
        $peralatan->harga_ganti = $request->input('harga_ganti');

        $peralatan->save();

        $stock = new Stock;

        $stock->id_peralatan = $peralatan->id_peralatan;
        $stock->stock = $request->input('stock');
        $stock->tersedia = $request->input('stock');
        $stock->keluar = 0;
        $stock->keterangan = 'Stock awal';

        $stock->save();


        toast('Data Berhasil Ditambahkan!', 'success', 'top-right');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data['peralatan'] = Peralatan::findOrFail($id);
        $data['satuan'] = Satuan::all();

        return view('peralatan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'nama_peralatan' => 'required',
            'stock' => 'required',
            'satuan' => 'required',
            'harga_sewa' => 'required',
            'harga_ganti' => 'required'
        ]);

        $peralatan = Peralatan::find($id);

        $peralatan->nama_peralatan = $request->input('nama_peralatan');
        $peralatan->id_satuan = $request->input('satuan');
        $peralatan->harga_sewa = $request->input('harga_sewa');
        $peralatan->harga_ganti = $request->input('harga_ganti');
        $peralatan->save();

        $stock = Stock::where('id_peralatan', $id)->first();

        $stock->id_peralatan = $id;
        $stock->stock = $request->input('stock');
        $stock->tersedia = $request->input('tersedia');
        $stock->keluar = $request->input('keluar');

        $stock->save();

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

    public function peralatanRusak()
    {
        $data['peralatan'] = Peralatan::all();
        $data['satuan'] = Satuan::all();
        $data['peralatanRusak'] = PeralatanRusak::where('jumlah_rusak', '>', 0)->get();
        return view('peralatan.peralatanRusak.index', $data);
    }

    public function storeSatuan(Request $request)
    {

        $this->validate($request, [
            'nama_satuan' => 'required',
        ]);

        $satuan = new Satuan;
        $satuan->nama_satuan = $request->input('nama_satuan');
        $satuan->save();

        toast('Data Berhasil Ditambahkan!', 'success', 'top-right');
        return redirect()->back();
    }

    public function stock($id)
    {
        $data['peralatan'] = Peralatan::findOrFail($id);
        $data['stock'] = Stock::where('id_peralatan', $id)->get();
        $data['stockBaru'] = Stock::where('id_peralatan', '=', $id)->latest()->first();



        return view('peralatan.stock', $data);
    }

    public function getStock($id)
    {
        $peralatan = Stock::find($id);
        return response()->json($peralatan);
    }

    public function EditStock(Request $request, $id)
    {
        // dd($request->all());

        $stock = Stock::find($id);
        $inputStock['id_peralatan'] = $stock->stock = $request->id_peralatan;
        $inputStock['stock'] = $stock->tersedia = $request->stock;
        $inputStock['tersedia'] =  $stock->keluar = $request->tersedia;
        $inputStock['keluar'] = $stock->keterangan = $request->keluar;
        $inputStock['keterangan'] = $stock->keterangan = $request->keterangan;
        Stock::Create($inputStock);

        toast('Data Berhasil Diubah!', 'success', 'top-right');
        return redirect()->back();
    }

    public function printPDF($id)
    {
        $data['peralatan'] = Peralatan::findOrFail($id);
        $data['stock'] = Stock::where('id_peralatan', $id)->get();
        $data['stockBaru'] = Stock::where('id_peralatan', '=', $id)->latest()->first();

        // dd($data['peralatanRusak']);
        $pdf = PDF::loadview('print.stock', $data);
        return $pdf->stream('test.pdf');
        // return $pdf->download('laporan-pegawai-pdf');
    }
}