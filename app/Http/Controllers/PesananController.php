<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\DetailPesanan;
use App\ListMakanan;
use App\JenisListMakanan;
use App\Pelanggan;
use App\Peralatan;
use App\Prasmanan;
use App\Menu;
use App\DetailMenu;
use Auth;
use DB;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();
        $menu = Menu::all();
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

        // $menu = Menu::all();
        // $detailMenu = DetailMenu::where('id_menu', '=', $id)->get();
        // $pelanggan = Pelanggan::all();
        // $listMakanan = ListMakanan::all();
        // $detailPesanan = DetailPesanan::where('id_pesanan', '=', $id)->get();
        // $pesanan = Pesanan::findOrFail($id);
        // $peralatan = Peralatan::all();
        // $prasmanan = Prasmanan::where('id_pesanan', '=', $id)->get();
        // $prasmananStatus = Prasmanan::where('id_pesanan', '=', $id)->first();

        $data['menu'] = Menu::all();
        $data['detailMenu'] = DetailMenu::where('id_menu', '=', $id)->get();
        $data['pelanggan'] = Pelanggan::all();
        $data['listMakanan'] = ListMakanan::all();
        $data['detailPesanan'] = DetailPesanan::where('id_pesanan', '=', $id)->get();
        $data['pesanan'] = Pesanan::findOrFail($id);
        $data['peralatan'] = Peralatan::all();

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
        $pesanan->bayar = $request->input('bayar');
        // $inputPesanan['id_users'] = Auth::user()->id_users;
        // $inputPesanan['tanggal'] = Carbon::now()->format('Y-m-d');
        // Merubah String ke tanggal

        // Jika Uang Bayar Lebih dari Harga
        if ($request->bayar > $request->total_harga) {
            $inputPesanan['bayar'] = $request->total_harga;
        }

        if ($request->total_harga <= $request->bayar) {
            $pesanan->status_bayar = 0;
        } else {
            $pesanan->status_bayar = 1;
        }


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
                    $inputPeralatan['tersedia'] = $value->tersedia - $request->jumlah_sewa[$key];
                    $inputPeralatan['keluar'] = $request->jumlah_sewa[$key];
                    // dd($value->keluar);
                    Peralatan::updateOrCreate($inputPeralatanID, $inputPeralatan);
                }
            } else {
                foreach ($deletePeralatan as $key => $value) {
                    $id_peralatan = $value->id_peralatan;
                    $jumlah = $value->jumlah_peralatan;
                    $value->delete();
                    // Barang Kembali
                    $stock = Peralatan::where('id_peralatan', $id_peralatan)->first();
                    $stock->keluar -= $jumlah;
                    $stock->tersedia += $jumlah;
                    $stock->save();
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
        $pesanan = Pesanan::all();
        // $data = DB::table('t_pesanan')->join('t_detail_pesanan', 't_detail_pesanan.id_')
        $detail = DetailPesanan::all();

        return view('pesanan.list.index', compact('pesanan', 'detail'));
    }

    public function detailPesanan($id)
    {

        $pesanan = Pesanan::findOrFail($id);
        $detail = DetailPesanan::where('id_pesanan', '=', $id)->get();
        $prasmanan = Prasmanan::where('id_pesanan', '=', $id)->get();
        $prasmananStatus = Prasmanan::where('id_pesanan', '=', $id)->first();
        // dd($prasmananStatus);
        return view('pesanan.list.detail', compact('pesanan', 'detail', 'prasmanan', 'prasmananStatus'));
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

        $last_pesanan = Pesanan::orderBy('id_pesanan', 'desc')->first();

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
        $inputPesanan['tanggal'] = Carbon::now()->format('Y-m-d');
        // Merubah String ke tanggal
        $time = strtotime($request->tanggal_pesanan);
        $newformat = date('Y-m-d', $time);
        $inputPesanan['tanggal_pesanan'] = $newformat;
        $inputPesanan['total_harga'] = $request->total_harga;
        $inputPesanan['keterangan'] = $request->keterangan;
        $inputPesanan['status_pesanan'] = 1;
        $inputPesanan['bayar'] = $request->bayar;

        // Jika Uang Bayar Lebih dari Harga
        if ($request->bayar > $request->total_harga) {
            $inputPesanan['bayar'] = $request->total_harga;
        }

        // Jika Melunasi
        if ($request->total_harga <= $request->bayar) {
            $inputPesanan['status_bayar'] = 0;
        } else {
            $inputPesanan['status_bayar'] = 1;
        }

        $pemesanan = Pesanan::create($inputPesanan);
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

        if (in_array(1, $request->status_peralatan)) {
            $inputPeralatan['id_pesanan'] = 'JSR-' . Carbon::now()->format('dmY') . '-' . $kode;
            foreach ($request->id_peralatan as $key => $value) {
                $inputPeralatan['id_peralatan'] = $value;
                $inputPeralatan['jumlah_peralatan'] = $request->jumlah_sewa[$key];
                $prasmanan = Prasmanan::create($inputPeralatan);
            }

            // Kurangi Stock

            $peralatan = Peralatan::findOrFail($request->id_peralatan);
            foreach ($peralatan as $key => $value) {
                $inputPeralatanID['id_peralatan'] = $request->id_peralatan[$key];
                $inputPeralatan['tersedia'] = $request->stock[$key] - $request->jumlah_sewa[$key];
                $inputPeralatan['keluar'] = $request->jumlah_sewa[$key];
                Peralatan::updateOrCreate($inputPeralatanID, $inputPeralatan);
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

    public function bayar(Request $request)
    {
        $pesanan = Pesanan::find($request->id_pesanan);

        $pesanan->bayar = $pesanan->bayar + $request->bayar_lagi;

        if ($pesanan->bayar >= $pesanan->total_harga) {
            $pesanan->status_bayar = 0;
        } else {
            $pesanan->status_bayar = 1;
        }

        $status = $pesanan->save();
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
                $stock = Peralatan::where('id_peralatan', $id_peralatan)->first();
                $stock->keluar -= $jumlah;
                $stock->tersedia += $jumlah;
                $stock->save();
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
                // Barang Kembali
                $stock = Peralatan::where('id_peralatan', $id_peralatan)->first();
                $stock->keluar -= $jumlah;
                $stock->tersedia += $jumlah;
                $stock->save();
            }
        }

        DetailPesanan::where('id_pesanan', '=', $id)->get()->each->delete();
        $pesanan->delete();

        // toast('Data Berhasil Dihapus!', 'success', 'top-right');
        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('admin/list_pesanan');
    }
}