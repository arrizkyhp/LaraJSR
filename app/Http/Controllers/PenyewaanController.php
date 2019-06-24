<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyewaan;
use App\Pelanggan;
use App\Peralatan;
use App\DetailPenyewaan;
use Carbon\Carbon;
use Auth;


class PenyewaanController extends Controller
{

    public function index()
    {
        $penyewaan = Penyewaan::all();
        $pelanggan = Pelanggan::all();
        $peralatan = Peralatan::all();
        return view('penyewaan.index', compact('penyewaan', 'pelanggan', 'peralatan'));
    }

    public function getPeralatan($id)
    {
        $peralatan = Peralatan::find($id);
        return response()->json($peralatan);
    }

    public function store(Request $request)
    {


        $this->validate($request, [
            'id_pelanggan' => 'required|exists:t_pelanggan,id_pelanggan',
            'nama_peralatan' => 'required',
            'harga' => 'required',
            'jumlah_sewa' => 'required',
            'harga' => 'required',
            'subtotal' => 'required',
            'total_harga' => 'required',
            'bayar' => 'required',
        ]);



        $last_penyewaan = Penyewaan::orderBy('id_penyewaan', 'desc')->first();

        if ($last_penyewaan != null) {
            $tests = $last_penyewaan->id_penyewaan;
        } else {
            $tests = 000;
        }

        $digit = substr($tests, -3);

        $kode = str_pad($digit + 1, 3, 0, STR_PAD_LEFT);


        $inputPenyewaan['id_penyewaan'] = 'SW-' . Carbon::now()->format('dmY') . '-' . $kode;

        $inputPenyewaan['id_pelanggan'] = $request->id_pelanggan;
        $inputPenyewaan['id_users'] = Auth::user()->id_users;
        // $inputPenyewaan['tanggal'] = Carbon::now()->format('Y-m-d');
        $inputPenyewaan['tanggal_penyewaan'] = $request->tanggal_penyewaan;
        $inputPenyewaan['tanggal_akhir'] = $request->tanggal_akhir;
        $inputPenyewaan['total_harga'] = $request->total_harga;
        $inputPenyewaan['keterangan'] = $request->keterangan;
        $inputPenyewaan['status_penyewaan'] = 1;
        $inputPenyewaan['bayar'] = $request->bayar;
        if ($request->total_harga <= $request->bayar) {
            $inputPenyewaan['status_bayar'] = 0;
        } else {
            $inputPenyewaan['status_bayar'] = 1;
        }

        $penyewaan = Penyewaan::create($inputPenyewaan);
        if ($penyewaan) {
            $inputDetail['id_penyewaan'] = 'SW-' . Carbon::now()->format('dmY') . '-' . $kode;
            foreach ($request->id_peralatan as $key => $peralatan_id) {
                $inputDetail['id_peralatan'] = $peralatan_id;
                $inputDetail['jumlah_sewa'] = $request->jumlah_sewa[$key];
                $inputDetail['harga_sewa'] = $request->harga[$key];
                $inputDetail['subtotal'] = $request->subtotal[$key];
                $detail = DetailPenyewaan::create($inputDetail);
            }
        }

        // Kurangi Stock

        if ($detail) {
            $peralatan = Peralatan::findOrFail($request->id_peralatan);

            foreach ($peralatan as $key => $value) {
                $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];
                $inputPeralatan['nama_peralatan'] = $value->nama_peralatan;
                $inputPeralatan['harga_sewa'] = $value->harga_sewa;
                $inputPeralatan['stock'] = $request->stock[$key] - $request->jumlah_sewa[$key];

                $alat = Peralatan::updateOrCreate($inputPeralatanID, $inputPeralatan);
            }
        }


        if ($alat) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect('admin/penyewaan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function listPenyewaan()
    {
        $penyewaan = Penyewaan::all();
        // $data = DB::table('t_pesanan')->join('t_detail_pesanan', 't_detail_pesanan.id_')
        $detail = DetailPenyewaan::all();

        return view('penyewaan.list.index', compact('penyewaan', 'detail'));
    }

    public function detailPenyewaan($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $detail = DetailPenyewaan::where('id_penyewaan', '=', $id)->get();
        return view('penyewaan.list.detail', compact('penyewaan', 'detail'));
    }
}