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



      <br><h4><b>Laporan Pesanan</b></h4>


                <div id="data">
                    <span class="detailInfo"><b> Dari Tanggal : </b> {{ date('d/m/Y' , strtotime($tanggalAwal)) }}</span><br>
                    <span class="detailInfo"><b> jumlah Data : </b> {{ $hitung }}</span><br>
                    <span id="desk"><b> di cetak oleh : </b> {{ auth()->user()->name  }}</span><br>
                </div>
            <div id="tanggal">
                    <span  ><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($tanggalAkhir)) }}</span><br><br><br><br>


            </div>


            <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                <th>Kode Pesanan</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Pelanggan</th>
                                <th>Operator</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah Bayar</th>
                                </tr>
                            </thead>

                            <tbody>

                                <td style='display:none;'> {{ $total = 0 }}</td>
                                @foreach ($pesanan as $pesan)
                                 <tr>

                                <td style='display:none;'>{{ $total += $pesan->bayar->last()->bayar }}</td>
                                <td>{{ $pesan->id_pesanan}}</td>
                                {{-- <td>
                                @foreach ($pesan->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td> --}}
                                <td>{{ $pesan->pelanggan->nama_pelanggan}}</td>
                                <td>{{  $pesan->user->name }}</td>
                                <td>{{ date('d/m/Y', strtotime($pesan->tanggal)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($pesan->tanggal_pesanan)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($pesan->bayar->last()->tanggal_bayar)) }}</td>
                                <td>Rp.{{ number_format( $pesan->bayar->last()->bayar,0,',', '.') }} </td>

                                    </tr>
                            </tbody>
                                     @endforeach

                    </table>
                </div>
                  <div id="data">
                     <span id="desk"><b> Waktu cetak : </b> {{ $tglSekarang }}</span><br>
                </div>

                   <div class="col-md-4">
                        <div id="tanggal">

                        <span class="detailSpan" ><h5><b>Total Pembayaran :</b> Rp.{{ number_format($total,2,',', '.') }}</h5></span><br>

                    </div>
                    </div>


        <div id="deskripsi">
            <b>Jembar Sari Rasa</b><br>
         Jln Barulaksana No.49 RT.03 RW.14 Jayagiri Lembang Bandung Barat<br>
         +62 821-1912-14111
      </div>

</body>
</html>