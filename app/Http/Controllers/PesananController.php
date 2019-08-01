<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\Bayar;
use App\DetailPesanan;
use App\ListMakanan;
use App\JenisListMakanan;
use App\Pelanggan;
use App\Peralatan;
use App\Prasmanan;
use App\Menu;
use App\Stock;
use App\DetailMenu;
use Auth;
use DB;
use PDF;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        $menu = Menu::orderBy('created_at', 'desc')->get();
        $pelanggan = Pelanggan::all();
        $listMakanan = ListMakanan::all();
        $peralatan = Peralatan::all();

        // Menu Form
        $jenisListMakanan = JenisListMakanan::orderBy('nama_jenis_makanan', 'asc')->get();
        $getMakanan = ListMakanan::with('jenis_makanan')->orderBy('nama_makanan', 'asc')->get();

        return view('pesanan.index', compact('pesanan', 'menu', 'pelanggan', 'listMakanan', 'peralatan', 'jenisListMakanan', 'getMakanan'));
    }

    public function edit($id)
    {

        $data['menu'] = Menu::all();
        $data['detailMenu'] = DetailMenu::where('id_menu', '=', $id)->get();
        $data['pelanggan'] = Pelanggan::all();
        $data['listMakanan'] = ListMakanan::all();
        $data['detailPesanan'] = DetailPesanan::where('id_pesanan', '=', $id)->get();
        $data['pesanan'] = Pesanan::findOrFail($id);
        $data['peralatan'] = Peralatan::all();
        $data['jumlahBayar'] = Bayar::where('id_pesanan', '=', $id)->sum('bayar');
        // Status Peralatan
        $data['prasmanan'] = Prasmanan::where('id_pesanan', '=', $id)->get();
        $data['prasmananStatus'] = Prasmanan::where('id_pesanan', '=', $id)->first();


        // Get List Makanan
        $ids = [];
        if ($data['detailMenu']->count() > 0) {
            foreach ($data['detailMenu'] as $key => $value) {
                $ids[$key] = $value->id_list_makanan;
            }
        }

        $data['selectedId'] = implode(',', $ids);

        // Menu Form
        $data['jenisListMakanan'] = JenisListMakanan::orderBy('nama_jenis_makanan', 'asc')->get();
        $data['getMakanan'] = ListMakanan::with('jenis_makanan')->orderBy('nama_makanan', 'asc')->get();

        return view('pesanan.edit.index', $data);
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());
        $this->validate($request, [
            'nama_menu' => 'required',
            'jenis_pesanan' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'subtotal' => 'required',
            'total_harga' => 'required',
            'bayar' => 'required',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->id_pelanggan = $request->input('id_pelanggan');
        $time = strtotime($request->tanggal_pesanan);
        $newformat = date('Y-m-d', $time);
        $pesanan->tanggal_pesanan = $newformat;
        $pesanan->id_pelanggan = $request->input('id_pelanggan');
        $pesanan->total_harga = $request->input('total_harga');
        $pesanan->keterangan = $request->input('keterangan');
        $pesanan->status_pesanan = 1;


        $pesanan->save();

        if ($pesanan) {
            // menghapus pesanan yang di delete
            DetailPesanan::where('id_pesanan', $pesanan->id_pesanan)->whereNotIn('id_menu', $request->id_menu)->delete();

            $inputDetail['id_pesanan'] = $pesanan->id_pesanan;
            foreach ($request->id_menu as $key => $menu_id) {
                $inputDetail['id_menu'] = $menu_id;
                $inputNom['quantity'] = $request->quantity[$key];
                $inputNom['harga'] = $request->harga[$key];
                $inputNom['subtotal'] = $request->subtotal[$key];
                $detail = DetailPesanan::updateOrCreate($inputDetail, $inputNom);
            }
        }

        // Peralatan

        if (in_array(1, $request->status_peralatan)) {

            // Kurangi Stock
            $deletePeralatan = Prasmanan::where('id_pesanan', $pesanan->id_pesanan)->whereNotIn('id_peralatan', $request->id_peralatan)->get();
            // dd($deletePeralatan);

            if ($deletePeralatan->isEmpty()) {
                $inputPeralatanId['id_pesanan'] = $pesanan->id_pesanan;
                foreach ($request->id_peralatan as $key => $value) {
                    $inputPeralatanId['id_peralatan'] = $value;
                    $inputPeralatan['jumlah_peralatan'] = $request->jumlah_sewa[$key];
                    Prasmanan::updateOrCreate($inputPeralatanId, $inputPeralatan);
                }


                $peralatan = Peralatan::findOrFail($request->id_peralatan);
                // dd($peralatan);

                foreach ($peralatan as $key => $value) {
                    $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];
                    $id_peralatan = $request->id_peralatan;

                    // $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();


                    // $inputStockID['stock'] = $stockSave->stock;
                    // $inputStockID['id_peralatan'] = $request->id_peralatan[$key];
                    // $inputStockID['tersedia'] = $request->jumlah_tersedia[$key];
                    // $inputStockID['keluar'] = $request->jumlah_sewa[$key];
                    // $inputStockID['keterangan'] = 'Mengubah Pesanan Peralatan ' .  $id;
                    // dd($value->keluar);
                    Peralatan::updateOrCreate($inputPeralatanID);
                    // Stock::Create($inputStockID);
                }
            } else {
                foreach ($deletePeralatan as $key => $value) {
                    $id_peralatan = $value->id_peralatan;
                    $jumlah = $value->jumlah_peralatan;
                    $value->delete();
                    // // Barang Kembali
                    // $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();


                    // $inputStock['id_peralatan'] = $id_peralatan;
                    // $inputStock['stock'] = $stockSave->stock;
                    // $inputStock['keluar'] = $stockSave->keluar -= $jumlah;
                    // $inputStock['tersedia'] = $stockSave->tersedia += $jumlah;
                    // $inputStock['keterangan'] = 'Mengubah Pesanan Peralatan ' .  $id;
                    // Stock::Create($inputStock);
                }
            }
        }


        if ($detail) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect('admin/list_pesanan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function listPesanan()
    {
        $pesanan = Pesanan::orderBy('created_at', 'desc')->get();
        // $data = DB::table('t_pesanan')->join('t_detail_pesanan', 't_detail_pesanan.id_')
        $detail = DetailPesanan::all();

        return view('pesanan.list.index', compact('pesanan', 'detail'));
    }

    public function detailPesanan($id)
    {

        $pesanan = Pesanan::findOrFail($id);
        $detail = DetailPesanan::where('id_pesanan', '=', $id)->get();
        $bayar = Bayar::where('id_pesanan', $id)->get();
        // mendapatkan tanggal bayar terbaru
        $tanggalBayar = Bayar::where('id_pesanan', $id)->orderBy('id_bayar', 'desc')->first();;
        $jumlahBayar = Bayar::where('id_pesanan', '=', $id)->sum('bayar');
        $prasmanan = Prasmanan::where('id_pesanan', '=', $id)->get();
        $prasmananStatus = Prasmanan::where('id_pesanan', '=', $id)->first();
        // dd($prasmananStatus);
        return view('pesanan.list.detail', compact('pesanan', 'detail', 'jumlahBayar', 'prasmanan', 'prasmananStatus', 'bayar', 'tanggalBayar'));
    }


    public function getDetail($id)
    {

        $detail_pesanan = DB::table('t_detail_pesanan')->where('id_pesanan', $id)->get();
        return response()->json($detail_pesanan);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'id_pelanggan' => 'required|exists:t_pelanggan,id_pelanggan',
            'nama_menu' => 'required',
            'jenis_pesanan' => 'required',
            'quantity' => 'required',
            'harga' => 'required',
            'subtotal' => 'required',
            'total_harga' => 'required',
            'bayar' => 'required',
        ]);

        $last_pesanan = Pesanan::latest()->first();

        if ($last_pesanan != null) {
            $tests = $last_pesanan->id_pesanan;
        } else {
            $tests = 000;
        }





        $digit = substr($tests, -3);

        $kode = str_pad($digit + 1, 3, 0, STR_PAD_LEFT);


        $inputPesanan['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
        $inputPesanan['id_pelanggan'] = $request->id_pelanggan;
        $inputPesanan['id_users'] = Auth::user()->id_users;
        // $inputPesanan['tanggal'] = Carbon::now()->format('Y-m-d');

        // Merubah String ke tanggal
        $getTanggal = strtotime($request->tanggal);
        $newformatTanggal = date('Y-m-d', $getTanggal);
        $inputPesanan['tanggal'] = $newformatTanggal;

        $time = strtotime($request->tanggal_pesanan);
        $newformat = date('Y-m-d', $time);
        $inputPesanan['tanggal_pesanan'] = $newformat;


        $inputPesanan['total_harga'] = $request->total_harga;
        $inputPesanan['keterangan'] = $request->keterangan;
        $inputPesanan['status_pesanan'] = 1;



        // Bayar
        $inputBayar['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
        $inputBayar['tanggal_bayar'] = Carbon::now()->format('Y-m-d');
        $inputBayar['keterangan'] = 'Pembayaran Awal';

        // Jika Uang Bayar Lebih dari Harga
        if ($request->bayar > $request->total_harga) {
            $inputBayar['bayar'] = $request->total_harga;
        } else {
            $inputBayar['bayar'] = $request->bayar;
        }


        // Jika Melunasi
        if ($request->total_harga <= $request->bayar) {
            $inputPesanan['status_bayar'] = 0;
        } else {
            $inputPesanan['status_bayar'] = 1;
        }

        $prasmanan = 0;
        if (in_array(1, $request->status_peralatan)) {
            $inputPeralatan['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
            foreach ($request->id_peralatan as $key => $value) {
                $inputPeralatan['id_peralatan'] = $value;
                $inputPeralatan['jumlah_peralatan'] = $request->jumlah_sewa[$key];
                Prasmanan::create($inputPeralatan);
                $prasmanan = 1;
            }
        }

        if ($prasmanan == 1) {
            $inputPesanan['status_alat'] = 1;
        } else {
            $inputPesanan['status_alat'] = 0;
        }



        $pemesanan = Pesanan::create($inputPesanan);
        Bayar::create($inputBayar);

        if ($pemesanan) {
            $inputDetail['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
            foreach ($request->id_menu as $key => $menu_id) {
                $inputDetail['id_menu'] = $menu_id;
                $inputDetail['quantity'] = $request->quantity[$key];
                $inputDetail['harga'] = $request->harga[$key];
                $inputDetail['subtotal'] = $request->subtotal[$key];
                $detail = DetailPesanan::create($inputDetail);
            }
        }

        // Simpan ke Tabel Prasmanan Jika Ada Peralatan




        if ($detail) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect('admin/list_pesanan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function bayar(Request $request)
    {

        // dd($test);
        $id = $request->id_pesanan;
        $tanggal_pesanan = Pesanan::where('id_pesanan', $id)->first();

        $tanggal_bayar = $request->tanggal_bayar;
        $test = 'pas';
        if ($tanggal_bayar < $tanggal_pesanan->tanggal) {
            alert()->error('Ooops', 'Tanggal yang diinputkan tidak sesuai!')->persistent('Close');
            return redirect()->back();
        }


        $pesanan = Pesanan::find($request->id_pesanan);


        $jumlahBayar = Bayar::where('id_pesanan', '=', $request->id_pesanan)->sum('bayar');

        $inputBayar['id_pesanan'] = $request->id_pesanan;
        $inputBayar['bayar'] = $request->bayar_lagi;
        $inputBayar['tanggal_bayar'] = $request->tanggal_bayar;
        $inputBayar['keterangan'] = $request->keterangan;
        $bayarHitung = $jumlahBayar + $request->bayar_lagi;


        if ($bayarHitung >= $request->total_harga) {
            $pesanan->status_bayar = 0;
        } else {
            $pesanan->status_bayar = 1;
        }

        $pesanan->save();
        $status = Bayar::create($inputBayar);;
        if ($status) {
            alert()->success('Berhasil', 'Data Berhasil diubah')->persistent('Close');
            return redirect()->back();
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function selesai($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->status_pesanan = 0;
        $prasmanan = Prasmanan::where('id_pesanan', '=', $id)->get();
        $prasmananStatus = Prasmanan::where('id_pesanan', '=', $id)->first();


        if ($prasmananStatus != null) {

            foreach ($prasmanan as $key => $value) {
                $id_peralatan = $value->id_peralatan;
                $jumlah = $value->jumlah_peralatan;
                $value->delete();
                // Barang Kembali
                $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();

                $inputStock['id_peralatan'] = $id_peralatan;
                $inputStock['stock'] = $stockSave->stock;
                $inputStock['keluar'] = $stockSave->keluar -= $jumlah;
                $inputStock['tersedia'] = $stockSave->tersedia += $jumlah;
                $inputStock['keterangan'] = 'Selesai Pesanan ' .  $id;
                Stock::Create($inputStock);
            }
        }
        $status = $pesanan->save();
        if ($status) {
            alert()->success('Berhasil', 'Pesanan Selesai')->persistent('Close');
            return redirect('admin/list_pesanan');
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::find($id);
        $prasmanan = Prasmanan::where('id_pesanan', '=', $id)->get();
        $prasmananStatus = Prasmanan::where('id_pesanan', '=', $id)->first();


        if ($prasmananStatus != null) {

            foreach ($prasmanan as $key => $value) {
                $id_peralatan = $value->id_peralatan;
                $jumlah = $value->jumlah_peralatan;
                $value->delete();

                if ($pesanan->status_alat == 0) {
                    $stockSave = Stock::where('id_peralatan', $id_peralatan)->latest()->first();

                    $inputStock['id_peralatan'] = $id_peralatan;
                    $inputStock['stock'] = $stockSave->stock;
                    $inputStock['keluar'] =  $stockSave->keluar -= $jumlah;
                    $inputStock['tersedia'] = $stockSave->tersedia += $jumlah;
                    $inputStock['keterangan'] = 'Menghapus Pesanan ' .  $id;
                    Stock::Create($inputStock);
                }
            }
        }

        DetailPesanan::where('id_pesanan', '=', $id)->get()->each->delete();
        Bayar::where('id_pesanan', '=', $id)->get()->each->delete();
        $pesanan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('admin/list_pesanan');
    }

    public function listPesananLaporan()
    {
        $data['pesanan'] = Pesanan::where('status_pesanan', 0)->get();
        $data['detail'] = DetailPesanan::all();

        return view('pesanan.laporan.index', $data);
    }

    public function printPDF($id)
    {
        $data['pesanan'] = Pesanan::findOrFail($id);
        $data['detail'] = DetailPesanan::where('id_pesanan', '=', $id)->get();
        $data['bayar'] = Bayar::where('id_pesanan', $id)->get();
        $data['tanggalBayar'] = Bayar::where('id_pesanan', $id)->orderBy('id_bayar', 'desc')->first();
        $data['jumlahBayar'] = Bayar::where('id_pesanan', '=', $id)->sum('bayar');
        $data['prasmanan'] = Prasmanan::where('id_pesanan', '=', $id)->get();
        $data['prasmananStatus'] = Prasmanan::where('id_pesanan', '=', $id)->first();


        // dd($data['peralatanRusak']);
        $pdf = PDF::loadview('print.detail', $data);
        return $pdf->stream('pesanan.pdf');
        // return $pdf->download('laporan-pegawai-pdf');
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

        $data['pesanan'] = Pesanan::with('bayar')->where('status_pesanan', 0)->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();
        $data['hitung'] = Pesanan::with('bayar')->where('status_pesanan', 0)->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->count();


        $pdf = PDF::loadview('print.pesanan', $data);
        return $pdf->stream('pesanan.pdf');
    }

    public function storePeralatan($id)
    {
        $prasmanan = Prasmanan::where('id_pesanan', $id)->get();
        $pesanan = Pesanan::findOrFail($id);
        // dd($prasmanan);

        // Kurangi Stock

        foreach ($prasmanan as $key => $value) {
            // $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];
            // $id_peralatan = $request->id_peralatan;
            // dd($value->jumlah_peralatan);


            $stockSave = Stock::where('id_peralatan', $value->id_peralatan)->latest()->first();

            $inputStockID['id_peralatan'] = $value->id_peralatan;
            $inputStockID['stock'] =  $stockSave->stock;
            $inputStockID['tersedia'] =  $stockSave->tersedia - $value->jumlah_peralatan;
            $inputStockID['keluar'] =  $stockSave->keluar + $value->jumlah_peralatan;
            $inputStockID['keterangan'] = 'Pesanan ' .  $id;

            Stock::Create($inputStockID);
        }
        $pesanan->status_alat = 0;
        $pesanan->save();
        alert()->success('Berhasil ', 'Data Berhasil dikonfirmasi')->persistent(' Close ');
        return redirect('admin/dashboard');
    }
}