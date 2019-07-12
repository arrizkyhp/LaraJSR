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



      <br><h4><b>Laporan Penyewaan</b></h4>


                <div id="data">
                    <span class="detailInfo"><b> Dari Tanggal : </b> {{ date('d/m/Y', strtotime($tanggalAwal )) }}</span><br>

                </div>
            <div id="tanggal">
                    <span  ><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($tanggalAkhir)) }}</span><br><br><br>


            </div>


            <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <thead>
                                <th>Kode Penyewaan</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Pelanggan</th>
                                <th>Operator</th>
                                <th>Tanggal Penyewaan</th>
                                <th>Tanggal Akhir</th>
                                <th>Tanggal Kembali</th>
                                <th>Total Bayar</th>
                                {{-- <th>Jumlah Bayar</th> --}}
                            </thead>
                        </tr>
                        <tr>
                            <tbody>
                                <td style='display:none;'> {{ $total = 0 }}</td>

                                @foreach ($penyewaan as $sewa)
                                <td style='display:none;'>{{ $total += $sewa->total_bayar}}</td>
                                <td>{{ $sewa->id_penyewaan}}</td>
                                {{-- <td>
                                @foreach ($sewa->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td> --}}
                                <td>{{ $sewa->pelanggan->nama_pelanggan}}</td>
                                <td>{{  $sewa->users->name }}</td>
                                <td>{{ $sewa->tanggal_penyewaan }}</td>
                                <td>{{ $sewa->tanggal_akhir }}</td>
                                <td>{{ $sewa->pengembalian->last()->tanggal_kembali }}</td>
                                <td>{{ $sewa->total_bayar }}</td>
                                {{-- <td>{{ $sewa->pengembalian->last()->bayar }}</td> --}}

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