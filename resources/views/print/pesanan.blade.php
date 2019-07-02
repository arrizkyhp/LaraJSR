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
                    <span class="detailInfo"><b> Dari Tanggal : </b> {{ $tanggalAwal }}</span><br>

                </div>
            <div id="tanggal">
                    <span  ><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($tanggalAkhir)) }}</span><br><br><br>


            </div>


            <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <thead>
                                <th>Kode Pesanan</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Pelanggan</th>
                                <th>Operator</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Pesanan</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah Bayar</th>
                            </thead>
                        </tr>
                        <tr>
                            <tbody>
                                <td style='display:none;'> {{ $total = 0 }}</td>

                                @foreach ($pesanan as $pesan)
                                <td style='display:none;'>{{ $total += $pesan->bayar->last()->bayar }}</td>
                                <td>{{ $pesan->id_pesanan}}</td>
                                {{-- <td>
                                @foreach ($pesan->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td> --}}
                                <td>{{ $pesan->pelanggan->nama_pelanggan}}</td>
                                <td>{{  $pesan->user->name }}</td>
                                <td>{{ $pesan->tanggal }}</td>
                                <td>{{ $pesan->tanggal_pesanan }}</td>
                                <td>{{ $pesan->bayar->last()->tanggal_bayar }}</td>
                                <td>{{ $pesan->bayar->last()->bayar }}</td>

                            </tbody>
                        </tr>
                        @endforeach
                    </table>
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