<?php

namespace App\Http\Controllers;

use App\Menu;
use App\JenisPesanan;
use Illuminate\Http\Request;
use App\DetailMenu;
use App\ListMakanan;
use App\JenisListMakanan;


class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $detailMenu = DetailMenu::all();
        $listMakanan = ListMakanan::all();
        $jenisListMakanan = JenisListMakanan::orderBy('nama_jenis_makanan', 'asc')->get();
        $getMakanan = ListMakanan::with('jenis_makanan')->orderBy('nama_makanan', 'asc')->get();
        // $jenisMenu = ListMakanan::with('jenis_makanan', 'nama_jenis_makanan')->orderBy('')->get();

        return view('menu.index', compact('menu', 'detailMenu', 'listMakanan', 'jenisListMakanan', 'getMakanan'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        return response()->json($menu);
    }

    public function create()
    {
        return view('menu/tambah');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'id_menu' => 'required|unique:t_menu',
            'id_jenis_pesanan' => 'required|exists:t_jenis_pesanan,id_jenis_pesanan',
            'nama_menu' => 'required',
            'id_list_makanan' => 'required',
            'harga' => 'required'
        ]);


        $menu = new \App\Menu;

        $inputMenu['id_menu'] = $request->id_menu;
        $inputMenu['id_jenis_pesanan'] = $request->id_jenis_pesanan;
        $inputMenu['nama_menu'] = $request->nama_menu;
        $inputMenu['harga'] = $request->harga;
        $inputMenu['keterangan'] = $request->keterangan;
        $inputMenu['status_peralatan'] = $request->status_peralatan;



        $menu = Menu::create($inputMenu);
        if ($menu) {
            $inputDetail['id_menu'] = $request->id_menu;
            foreach ($request->id_list_makanan as $menu_id) {
                $inputDetail['id_list_makanan'] = $menu_id;

                $detail = DetailMenu::create($inputDetail);
            }
        }

        if ($detail) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect()->back();
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        $detailMenu = DetailMenu::where('id_menu', '=', $id)->get();
        $jenisListMakanan = JenisListMakanan::orderBy('nama_jenis_makanan', 'asc')->get();
        $getMakanan = ListMakanan::with('jenis_makanan')->orderBy('nama_makanan', 'asc')->get();

        $ids = [];
        if ($detailMenu->count() > 0) {
            foreach ($detailMenu as $key => $value) {
                $ids[$key] = $value->id_list_makanan;
            }
        }
        $selectedId = implode(',', $ids);

        $listMakanan = ListMakanan::all();
        // dd($listMakanan);
        // dd($selectedId);
        return view('menu.edit', compact('menu', 'detailMenu', 'jenisListMakanan', 'selectedId', 'getMakanan'));
    }
    public function calculateHarga($ids)
    {
        $arrId = explode(',', $ids);
        $listMakanan = ListMakanan::whereIn('id_list_makanan', $arrId)->get();
        $harga = 0;
        foreach ($listMakanan as $v) {
            $harga += $v->harga;
        }
        return $harga;
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_jenis_pesanan' => 'required|exists:t_jenis_pesanan,id_jenis_pesanan',
            'nama_menu' => 'required',
            // 'id_list_makanan' => 'required',
            'harga' => 'required'
        ]);

        $menu = Menu::findOrFail($id);



        $menu->id_jenis_pesanan = $request->input('id_jenis_pesanan');
        $menu->nama_menu = $request->input('nama_menu');
        $menu->keterangan = $request->input('keterangan');
        $menu->harga = $request->input('harga');

        if ($request->status_peralatan == "") {
            $menu->status_peralatan = 0;
        } elseif ($request->status_peralatan == "on") {
            $menu->status_peralatan = 1;
        }

        $menu->save();

        if ($menu) {
            // Check value yang tidak di select
            DetailMenu::where('id_menu', $request->id_menu)->whereNotIn('id_list_makanan', $request->id_list_makanan)->delete();

            $inputDetail['id_menu'] = $request->id_menu;
            foreach ($request->id_list_makanan as $menu_id) {
                $inputDetail['id_list_makanan'] = $menu_id;

                $detail = DetailMenu::firstOrCreate($inputDetail);
            }
        }

        if ($detail) {
            alert()->success('Berhasil', 'Data Berhasil ditambahkan')->persistent('Close');
            return redirect()->back();
        } else {
            alert()->error('Error', 'Data gagal ditambahkan')->persistent('Close');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        DetailMenu::where('id_menu', '=', $id)->get()->each->delete();
        $menu->delete();


        alert()->success('Berhasil ', 'Data Berhasil dihapus')->persistent(' Close ');
        return redirect('admin/menu');
    }

    public function getInitial($id)
    {
        $jenis_pesanan = JenisPesanan::find($id);
        // $menu = Menu::where('id_menu', $id)->orderBy('id_menu', 'desc')->first();
        // if ($menu != null) {
        //     // $warna = BarangWarna::where('barang_id', $barang->id)->orderBy('id', 'desc')->first();
        //     // if ($warna != null) {
        //     // $kode_stok_arr = explode('-', $warna->barang_stok[0]->kode_stok);
        //     // $kode_stok_str = $kode_stok_arr[1];
        //     // } else {
        //     //     $kode_stok_str = '0000';
        //     // }
        // } else {
        //     $kode_stok_str = '0000';
        // }



        // $kodeInt = ((int)$kode_stok_str) + 1;
        // if (strlen((string)$kodeInt) == 1) {
        //     $kd = '0000' . $kodeInt;
        // } else if (strlen((string)$kodeInt) == 2) {
        //     $kd = '000' . $kodeInt;
        // } else if (strlen((string)$kodeInt) == 3) {
        //     $kd = '00' . $kodeInt;
        // } else if (strlen((string)$kodeInt) == 4) {
        //     $kd = '0' . $kodeInt;
        // } else if (strlen((string)$kodeInt) == 5) {
        //     $kd = (string)$kodeInt;
        // }
        // // return $jenis_pesanan->kode . '-' . $kd;
        // return $jenis_pesanan->kode . $kd;

        $kode = $jenis_pesanan->kode;

        $menu = Menu::where('id_menu', 'LIKE', $kode . '%')->orderBy('id_menu', 'desc')->first();

        if ($menu != null) {
            $tests = $menu->id_menu;
        } else {
            $tests = 000;
        }
        $digit = substr($tests, -3);


        $test = $kode . str_pad($digit + 1, 3, 0, STR_PAD_LEFT);


        return $test;
    }
}