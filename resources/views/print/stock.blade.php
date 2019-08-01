<!DOCTYPE html>
<html lang="en">
<head>
       <link rel="stylesheet" href="{{ public_path('vendors/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css">
       <link rel="stylesheet" href="{{ public_path('assets/css/print.css') }}" type="text/css">
</head>
<body>
     <div id="logo">
        <img src="{{ public_path('front/img/logo.png') }}">
      </div>



     <h4><b>Laporan Stock {{ $peralatan->nama_peralatan }}</b></h4>


                <div id="data">
                    <span class="detailInfo"><b> Dari Tanggal : </b> {{ date('d/m/Y', strtotime($tanggalAwal)) }} </span><br>
                    <span class="detailInfo"><b> jumlah Data : </b> {{ $hitung }}</span><br>
                    <span id="desk"><b> di cetak oleh : </b> {{ auth()->user()->name  }}</span><br>
                </div>
            <div id="tanggal">
                    <span  ><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($tanggalAkhir)) }}</span><br>
                    <span  ><b> Satuan : </b> {{ $peralatan->satuan->nama_satuan }}</span><br><br><br>


            </div>


            <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                            <thead>
                                  <tr>
                                <th>Tanggal</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Stock Awal</th>
                                <th>Tersedia</th>
                                <th>Keluar</th>
                                <th>Keterangan</th>
                                  </tr>
                            </thead>


                            <tbody>


                                @foreach ($stock as $stok)
                                <tr>
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $stok->created_at)->format('d/m/Y') }}</td>
                                {{-- <td>
                                @foreach ($stok->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td> --}}
                                <td>{{ $stok->stock}}</td>
                                <td>{{ $stok->tersedia }}</td>
                                <td>{{ $stok->keluar }}</td>
                                <td>{{ $stok->keterangan }}</td>
                                </tr>
                            </tbody>

                        @endforeach
                    </table>
                </div>
                   <div class="col-md-4">
                       <div id="data">
                     <span id="desk"><b> Waktu cetak : </b> {{ $tglSekarang }}</span><br>
                        </div>
                          <div id="tanggal">
                        <span class="detailInfo"><b> Manajer Operasional</b></span><br><br><br>
                        <span class="detailInfo"><b> ................... </b></span><br>
                             </div>
                    </div>

                    <br><br>
        <div id="deskripsi">
            <b>Jembar Sari Rasa</b><br>
         Jln Barulaksana No.49 RT.03 RW.14 Jayagiri Lembang Bandung Barat<br>
         +62 821-1912-14111
      </div>

</body>
</html>