<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyewaan;
use App\Pelanggan;
use App\Peralatan;
use App\DetailPenyewaan;
use App\Pengembalian;
use App\PeralatanRusak;
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

        // dd($request->all());
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
        $inputPenyewaan['total_bayar'] = $request->total_harga;
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

    public function pengembalian(Request $request, $id)
    {

        $this->validate($request, [
            'tanggal_kembali' => 'required',
            'jumlah_kembali' => 'required',
            'bayar_lagi' => 'required',
        ]);

        $penyewaan = Penyewaan::findOrFail($id);
        $penyewaan->id_pelanggan = $penyewaan->id_pelanggan;
        $penyewaan->total_bayar = $penyewaan->total_harga + $request->total_denda;
        $penyewaan->bayar = $request->bayar_lagi + $request->bayar_dp;
        $bayar = $request->bayar_lagi + $request->bayar_dp;
        $total_harga = $penyewaan->total_harga + $request->total_denda;



        if ($bayar === $total_harga) {
            $penyewaan->status_bayar  = 0;
        } else {
            $penyewaan->status_bayar = 1;
        }

        $penyewaan->status_penyewaan = 0;
        $penyewaan->save();


        if ($penyewaan) {

            // Buat Kode
            $last_pengembalian = Pengembalian::orderBy('id_pengembalian', 'desc')->first();

            if ($last_pengembalian != null) {
                $tests = $last_pengembalian->id_pengembalian;
            } else {
                $tests = 000;
            }

            $digit = substr($tests, -3);

            $kode = str_pad($digit + 1, 3, 0, STR_PAD_LEFT);


            $inputPengembalian['id_pengembalian'] = 'KBL-' . Carbon::now()->format('dmY') . '-' . $kode;
            $inputPengembalian['id_penyewaan'] = $request->id_penyewaan;
            $inputPengembalian['tanggal_kembali'] = $request->tanggal_kembali;
            $inputPengembalian['denda_per_hari'] = 50000;
            $inputPengembalian['denda_telat'] = $request->denda_telat;
            $inputPengembalian['denda_ganti'] = $request->denda_ganti;
            $inputPengembalian['total_denda'] = $request->total_denda;
            $pengembalian = Pengembalian::create($inputPengembalian);
        }

        // Barang Rusak

        if ($request->denda_ganti > 0) {
            $idPenyewaan = $request->id_penyewaan;

            $detailPenyewaan = DetailPenyewaan::where('id_penyewaan', '=', $idPenyewaan)->get();

            $inputRusak['id_pengembalian'] = 'KBL-' . Carbon::now()->format('dmY') . '-' . $kode;
            foreach ($detailPenyewaan as $key => $peralatan_id) {
                $inputRusak['id_peralatan'] = $peralatan_id->id_peralatan;
                $inputRusakNom['jumlah_rusak'] =  $peralatan_id->jumlah_sewa -= $request->jumlah_kembali[$key];

                $rusak = PeralatanRusak::updateOrCreate($inputRusak, $inputRusakNom);
            }
        }

        // Perlengkapan Kembali

        if ($pengembalian) {
            $idDPenyewaan = $request->id_penyewaan;
            $dPenyewaan = DetailPenyewaan::where('id_penyewaan', '=', $idDPenyewaan)->get();

            foreach ($dPenyewaan as $key => $value) {
                $id_peralatan = $value->id_peralatan;
                $jumlah = $request->jumlah_kembali[$key];
                $stock = Peralatan::where('id_peralatan', $id_peralatan)->first();
                $stock->stock += $jumlah;
                $stock->save();
            }
        }

        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('admin/list_penyewaan');
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $detailPenyewaan = DetailPenyewaan::where('id_penyewaan', '=', $id)->get();

        foreach ($detailPenyewaan as $key => $value) {
            $id_peralatan = $value->id_peralatan;
            $jumlah = $value->jumlah_sewa;
            $status = $value->delete();
            if ($penyewaan->status_penyewaan == 1) {

                if ($status) {
                    $stock = Peralatan::where('id_peralatan', $id_peralatan)->first();
                    $stock->stock += $jumlah;
                    $stock->save();
                }
            }
        }
        $penyewaan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('admin/list_penyewaan');
    }
}