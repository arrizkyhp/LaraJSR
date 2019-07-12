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



      <br><h4><b>Laporan Peralatan Rusak/Tidak</b></h4>


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
                                <th>Tanggal</th>
                                <th>Kode Penyewaan</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Nama Peralatan</th>
                                <th>Jumlah</th>
                                <th>Unit</th>

                            </thead>
                        </tr>
                        <tr>
                            <tbody>
                                <td style='display:none;'> {{ $total = 0 }}</td>

                                @foreach ($peralatanRusak as $alatR)
                                {{-- <td style='display:none;'>{{ $total += $sewa->total_bayar}}</td> --}}
                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $alatR->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $alatR->pengembalian->id_penyewaan}}</td>
                                {{-- <td>
                                @foreach ($alatR->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td> --}}
                                <td>{{ $alatR->peralatan->nama_peralatan}}</td>
                                <td>{{ $alatR->jumlah_rusak }}</td>
                                <td>{{ $alatR->peralatan->satuan->nama_satuan }}</td>
                                {{-- <td>{{ $sewa->pengembalian->last()->bayar }}</td> --}}

                            </tbody>
                        </tr>
                        @endforeach
                    </table>
                </div>


                <br>
        <div id="deskripsi">
            <b>Jembar Sari Rasa</b><br>
         Jln Barulaksana No.49 RT.03 RW.14 Jayagiri Lembang Bandung Barat<br>
         +62 821-1912-14111
      </div>

</body>
</html>