<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penyewaan;
use App\Pelanggan;
use App\Peralatan;
use App\DetailPenyewaan;
use App\Pengembalian;
use App\PeralatanRusak;
use App\Stock;
use Carbon\Carbon;
use Auth;
use PDF;

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
        $peralatan = Peralatan::with('stocks', 'satuan')->find($id);
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


        //  Check apakah jumlah sewa melebihi stock ?
        if ($request->jumlah_sewa > $request->stock) {
            alert()->error('Error', 'Stock Peralatan tidak mencukupi')->persistent('Close');
            return redirect('admin/penyewaan');
        }


        $last_penyewaan = Penyewaan::latest()->first();
        // $last_penyewaan = Penyewaan::orderBy('id_penyewaan', 'asc')->first();

        if ($last_penyewaan != null) {
            $tests = $last_penyewaan->id_penyewaan;
        } else {
            $tests = 000;
        }

        $digit = substr($tests, -3);

        $kode = str_pad($digit + 1, 3, 0, STR_PAD_LEFT);


        $inputPenyewaan['id_penyewaan'] = 'SW-' . Carbon::now()->format('dmY') . '-' . $kode;
        // dd($inputPenyewaan['id_penyewaan']);
        $inputPenyewaan['id_pelanggan'] = $request->id_pelanggan;
        $inputPenyewaan['id_users'] = Auth::user()->id_users;
        // $inputPenyewaan['tanggal'] = Carbon::now()->format('Y-m-d');
        // Merubah String ke tanggal
        $getTanggal = strtotime($request->tanggal_penyewaan);
        $newformatTanggal = date('Y-m-d', $getTanggal);
        $inputPenyewaan['tanggal_penyewaan'] = $newformatTanggal;

        $time = strtotime($request->tanggal_akhir);
        $newformat = date('Y-m-d', $time);
        $inputPenyewaan['tanggal_akhir'] = $newformat;

        $inputPenyewaan['total_harga'] = $request->total_harga;
        $inputPenyewaan['total_bayar'] = $request->total_harga;
        $inputPenyewaan['keterangan'] = $request->keterangan;
        $inputPenyewaan['status_penyewaan'] = 1;
        $inputPenyewaan['status_alat'] = 1;
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



                $alat = Peralatan::updateOrCreate($inputPeralatanID);
                // Stock::Create($inputStockID);
            }
        }


        if ($detail) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect('admin/list_penyewaan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function listPenyewaan()
    {
        $penyewaan = Penyewaan::orderBy('created_at', 'DESC')->get();
        // $data = DB::table('t_pesanan')->join('t_detail_pesanan', 't_detail_pesanan.id_')
        $detail = DetailPenyewaan::all();

        return view('penyewaan.list.index', compact('penyewaan', 'detail'));
    }

    public function detailPenyewaan($id)
    {
        $data['penyewaan'] = Penyewaan::findOrFail($id);
        $data['detail'] = DetailPenyewaan::where('id_penyewaan', '=', $id)->get();
        $data['pengembalian'] = Pengembalian::where('id_penyewaan', '=', $id)->first();
        // dd($data['pengembalian']);

        if ($data['pengembalian'] == null) {
            # code...
            $data['peralatanRusak'] = PeralatanRusak::where('id_pengembalian', '=', null)->get();
        } else {
            $data['peralatanRusak'] = PeralatanRusak::where('id_pengembalian', '=', $data['pengembalian']->id_pengembalian)->get();
            // dd($data['peralatanRusak']);

        }
        // dd($data['peralatanRusak']);
        return view('penyewaan.list.detail', $data);
    }

    public function pengembalian(Request $request, $id)
    {
        // dd($request->all());
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
            $last_pengembalian = Pengembalian::latest()->first();
            // $last_pengembalian = Pengembalian::orderBy('id_pengembalian', 'asc')->first();

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

            // Kurangi Stock

            $idDPenyewaan = $request->id_penyewaan;
            $dPenyewaan = DetailPenyewaan::where('id_penyewaan', '=', $idDPenyewaan)->get();

            foreach ($dPenyewaan as $key => $value) {
                $id_peralatan = $value->id_peralatan;
                $jumlah = $request->jumlah_kembali[$key];

                $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();
                $stockMinus = $stockSave->stock - $jumlah;
                $kembali = $stockSave->stock - $stockMinus;

                $inputStock['id_peralatan'] =  $id_peralatan;
                $inputStock['keluar'] = $stockSave->keluar -= $kembali + $stockMinus;
                $inputStock['tersedia'] = $stockSave->tersedia += $jumlah;
                $inputStock['stock'] = $stockSave->stock -= $stockMinus;
                $inputStock['keterangan'] = 'Pengembalian Penyewaan ' .  $id;
                Stock::Create($inputStock);
            }
        } else {
            // Perlengkapan Kembali

            $idDPenyewaan = $request->id_penyewaan;
            $dPenyewaan = DetailPenyewaan::where('id_penyewaan', '=', $idDPenyewaan)->get();

            foreach ($dPenyewaan as $key => $value) {
                $id_peralatan = $value->id_peralatan;
                $jumlah = $request->jumlah_kembali[$key];
                $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();
                $inputStockID['id_peralatan'] = $id_peralatan;
                $inputStockID['stock'] = $stockSave->stock;
                $inputStockID['keluar'] = $stockSave->keluar -= $jumlah;
                $inputStockID['tersedia'] =  $stockSave->tersedia += $jumlah;
                $inputStockID['keterangan'] = 'Pengembalian Penyewaan ' .  $id;
                Stock::Create($inputStockID);
            }
        }


        alert()->success('Berhasil ', 'Data Berhasil diubah')->persistent(' Close ');
        return redirect('admin/list_penyewaan');
    }

    public function edit($id)
    {

        $data['penyewaan'] = Penyewaan::findOrFail($id);
        $data['detailPenyewaan'] = DetailPenyewaan::where('id_penyewaan', $id)->get();
        $data['pelanggan'] = Pelanggan::all();
        $data['peralatan'] = Peralatan::all();

        return view('penyewaan.edit.index', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $penyewaan = Penyewaan::findOrFail($id);

        $penyewaan->id_pelanggan = $request->input('id_pelanggan');

        $time = strtotime($request->tanggal_akhir);
        $newformat = date('Y-m-d', $time);
        $penyewaan->tanggal_akhir = $newformat;
        $penyewaan->keterangan = $request->input('keterangan');
        $penyewaan->total_harga = $request->input('total_harga');

        $penyewaan->save();

        if ($penyewaan) {
            // menghapus penyewaan yang di delete
            $deletePeralatan = DetailPenyewaan::where('id_penyewaan', $id)->whereNotIn('id_peralatan', $request->id_peralatan)->get();

            if ($deletePeralatan->isEmpty()) {
                $inputDetail['id_penyewaan'] = $id;
                foreach ($request->id_peralatan as $key => $value) {
                    $inputDetail['id_peralatan'] = $value;
                    $inputNom['jumlah_sewa'] = $request->jumlah_sewa[$key];
                    $inputNom['subtotal'] = $request->subtotal[$key];
                    DetailPenyewaan::updateOrCreate($inputDetail, $inputNom);
                }

                // Peralatan

                $peralatan = Peralatan::findOrFail($request->id_peralatan);

                foreach ($peralatan as $key => $value) {
                    $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];

                    // $stockSave = Stock::where('id_peralatan', $request->id_peralatan[$key])->latest()->first();

                    // $inputStockID['id_peralatan'] = $request->id_peralatan[$key];
                    // $inputStockID['stock'] = $stockSave->stock;
                    // $inputStockID['tersedia'] = $request->jumlah_tersedia[$key];
                    // $inputStockID['keluar'] = $request->jumlah_sewa[$key];
                    // $inputStockID['keterangan'] = 'Mengubah Penyewaan (tambah) ' .  $inputDetail['id_penyewaan'];
                    Peralatan::updateOrCreate($inputPeralatanID);
                    // Stock::Create($inputStockID);
                }
            } else {

                $bayar = $request->bayar;
                $total_harga = $request->total_harga;

                if ($bayar >= $total_harga) {
                    $penyewaan->status_bayar  = 0;
                } elseif ($bayar < $total_harga) {
                    $penyewaan->status_bayar  = 1;
                }

                $penyewaan->save();

                foreach ($deletePeralatan as $key => $value) {
                    $id_peralatan = $value->id_peralatan;
                    $jumlah = $request->jumlah_sewa[$key];
                    $value->delete();
                    // // Barang Kembali
                    // $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();

                    // $inputStock['id_peralatan'] = $id_peralatan;
                    // $inputStock['stock'] = $stockSave->stock;
                    // $inputStock['keluar'] =  $stockSave->keluar -= $jumlah;
                    // $inputStock['tersedia'] = $stockSave->tersedia += $jumlah;
                    // $inputStock['keterangan'] = 'Mengubah Penyewaans (Hapus) ' .  $id;
                    // Stock::Create($inputStock);
                }
                $peralatan = Peralatan::findOrFail($request->id_peralatan);


                foreach ($peralatan as $key => $value) {
                    $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];


                    // $inputStockID['id_peralatan'] = $request->id_peralatan[$key];
                    // $inputStockID['stock'] = $stockSave->stock;
                    // $inputStockID['tersedia'] = $request->jumlah_tersedia[$key];
                    // $inputStockID['keluar'] = $request->jumlah_sewa[$key];
                    // $inputStockID['keterangan'] = 'Mengubah Penyewaana (Hapus) ' .  $id;
                    Peralatan::updateOrCreate($inputPeralatanID);
                    // Stock::Create($inputStockID);
                }
            }
        }

        alert()->success('Berhasil', 'Data Berhasil diubah')->persistent('Close');
        return redirect('admin/list_penyewaan');
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $kembaliCek = Pengembalian::where('id_penyewaan', $id)->first();
        $detailPenyewaan = DetailPenyewaan::where('id_penyewaan', '=', $id)->get();


        // Cek Apakah ada Peralatan Rusak




        foreach ($detailPenyewaan as $key => $value) {
            $id_peralatan = $value->id_peralatan;
            $jumlah = $value->jumlah_sewa;
            $status = $value->delete();
            if ($penyewaan->status_penyewaan == 1) {


                if ($penyewaan->status_alat == 0) {

                    $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();

                    $inputStock['id_peralatan'] = $id_peralatan;
                    $inputStock['stock'] = $stockSave->stock;
                    $inputStock['keluar'] = $stockSave->keluar -= $jumlah;
                    $inputStock['tersedia'] = $stockSave->tersedia += $jumlah;
                    $inputStock['keterangan'] = 'Menghapus Penyewaan ' .  $id;
                    Stock::Create($inputStock);
                }
            } else {
                $kembali = Pengembalian::where('id_penyewaan', $id)->get()->each->delete();
                $peralatanRusak = PeralatanRusak::where('id_pengembalian', $kembaliCek->id_pengembalian)->get()->each->delete();
            }
        }
        $penyewaan->delete();


        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('admin/list_penyewaan');
    }

    public function printPDF($id)
    {
        $data['penyewaan'] = Penyewaan::findOrFail($id);
        $data['detail'] = DetailPenyewaan::where('id_penyewaan', '=', $id)->get();
        $data['pengembalian'] = Pengembalian::where('id_penyewaan', '=', $id)->first();
        // dd($data['pengembalian']);

        if ($data['pengembalian'] == null) {
            # code...
            $data['peralatanRusak'] = PeralatanRusak::where('id_pengembalian', '=', null)->get();
        } else {
            $data['peralatanRusak'] = PeralatanRusak::where('id_pengembalian', '=', $data['pengembalian']->id_pengembalian)->get();
            // dd($data['peralatanRusak']);

        }
        // dd($data['peralatanRusak']);
        $pdf = PDF::loadview('penyewaan.print.index', $data);
        return $pdf->stream('test.pdf');
        // return $pdf->download('laporan-pegawai-pdf');
    }

    public function storePeralatan($id)
    {
        $dPenyewaan = DetailPenyewaan::where('id_penyewaan', $id)->get();
        $penyewaan = Penyewaan::findOrFail($id);
        // dd($prasmanan);

        // Kurangi Stock

        foreach ($dPenyewaan as $key => $value) {
            // $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];
            // $id_peralatan = $request->id_peralatan;
            // dd($value->jumlah_peralatan);


            $stockSave = Stock::where('id_peralatan', $value->id_peralatan)->latest()->first();

            $inputStockID['id_peralatan'] = $value->id_peralatan;
            $inputStockID['stock'] =  $stockSave->stock;
            $inputStockID['tersedia'] =  $stockSave->tersedia - $value->jumlah_sewa;
            $inputStockID['keluar'] =  $stockSave->keluar + $value->jumlah_sewa;
            $inputStockID['keterangan'] = 'Disewakan ' .  $id;

            // dd($inputStockID);

            Stock::Create($inputStockID);
        }
        $penyewaan->status_alat = 0;
        $penyewaan->save();
        alert()->success('Berhasil ', 'Data Berhasil dikonfirmasi')->persistent(' Close ');
        return redirect('admin/dashboard');
    }

    public function laporan(Request $request)
    {
        // dd($request->all());
        $data['tanggalAwal']  = $request->tanggal_penyewaan;
        $data['tanggalAkhir'] = $request->tanggal_akhir;
        $data['tglSekarang'] = Carbon::now('Asia/Jakarta')->format('l, d F Y H:i:s');

        $time = strtotime($request->tanggal_penyewaan);
        $waktu = strtotime($request->tanggal_akhir);

        $tanggalAwal = date('Y-m-d', $time);
        $tanggalAkhir = date('Y-m-d', $waktu);
        // dd($data['tanggalAkhir']);

        $data['penyewaan'] = Penyewaan::where('status_penyewaan', 0)->whereBetween('tanggal_penyewaan', [$tanggalAwal, $tanggalAkhir])->get();
        $data['hitung'] = Penyewaan::where('status_penyewaan', 0)->whereBetween('tanggal_penyewaan', [$tanggalAwal, $tanggalAkhir])->count();


        $pdf = PDF::loadview('print.penyewaan', $data);
        return $pdf->stream('penyewaan.pdf');
    }
}