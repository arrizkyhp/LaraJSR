<?php

namespace App\Http\Controllers;

use App\Menu;
use App\JenisPesanan;
use Illuminate\Http\Request;
use App\DetailMenu;
use App\ListMakanan;


class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $detailMenu = DetailMenu::all();
        $listMakanan = ListMakanan::all();
        return view('menu.index', compact('menu', 'detailMenu', 'listMakanan'));
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
        // dd($request->all());
        $this->validate($request, [
            'id_menu' => 'required|unique:t_menu',
            'id_jenis_pesanan' => 'required|exists:t_jenis_pesanan,id_jenis_pesanan',
            'nama_menu' => 'required',
            'id_list_makanan' => 'required',
            'harga' => 'required'
        ]);


        $menu = new \App\Menu;

        // $menu->id_menu = $request->input('id_menu');
        // $menu->id_jenis_pesanan = $request->input('id_jenis_pesanan');
        // $menu->nama_menu = $request->input('nama_menu');
        // $menu->deskripsi = $request->input('deskripsi');
        // $menu->harga = $request->input('harga');

        $inputMenu['id_menu'] = $request->id_menu;
        $inputMenu['id_jenis_pesanan'] = $request->id_jenis_pesanan;
        $inputMenu['nama_menu'] = $request->nama_menu;
        $inputMenu['harga'] = $request->harga;
        $inputMenu['keterangan'] = $request->keterangan;





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
        return view('menu.edit', compact('menu', 'detailMenu', 'listMakanan', 'selectedId'));
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

        $menu->save();

        // if ($menu) {
        //     $inputDetail['id_menu'] = $request->id_menu;
        //     foreach ($request->id_list_makanan as $menu_id) {
        //         $inputDetail['id_list_makanan'] = $menu_id;

        //         $detail = DetailMenu::create($inputDetail);
        //     }
        // }

        if ($menu) {
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