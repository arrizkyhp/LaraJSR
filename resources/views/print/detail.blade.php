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



      <h4><b>{{ $pesanan->id_pesanan }}</b></h4>

                <div id="data">
                    <span class="detailInfo"><b> Nama Pemesan : </b> {{ $pesanan->pelanggan->nama_pelanggan }}</span><br>
                    <span class="detailInfo"><b> Alamat : </b> {{ $pesanan->pelanggan->alamat }}</span><br>
                    <span class="detailInfo"><b> Operator : </b> {{ $pesanan->user->name }}</span>
                </div>
            <div id="tanggal">
                    <span  ><b> Tanggal Pesan: </b> {{ date('d/m/Y', strtotime($pesanan->tanggal)) }}</span><br>
                    <span ><b> Untuk Tanggal : </b> {{ date('d/m/Y', strtotime($pesanan->tanggal_pesanan)) }}</span><br>
                    @if ($pesanan->status_pesanan == 1)

                    @else
                          <span style="margin-right:5px; float:right;"><b> Tanggal Pelunasan : </b> {{ date('d/m/Y', strtotime($tanggalBayar->tanggal_bayar)) }}</span>
                    @endif
                    <br><br>

            </div>

            {{-- <div id="status">
                 @if ($penyewaan->status_penyewaan == 0)
                    <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Selesai </span></h3><br><br>
                    @elseif($penyewaan->status_penyewaan == 1)
                    <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Selesai </span></h3><br><br>
                    @endif

            </div> --}}

            <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                            <thead>
                                <tr>
                                <th>Nama Menu</th>
                                {{-- <th>Deskripsi</th> --}}
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                @foreach ($detail as $details)
                                <td>{{ $details->menu->nama_menu}}</td>
                                {{-- <td>
                                @foreach ($details->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td> --}}
                                <td>{{ $details->quantity}}</td>
                                <td>{{  number_format($details->harga,0,',', '.') }}</td>
                                <td>{{  number_format($details->subtotal,0,',', '.') }}</td>
                                    </tr>
                            </tbody>

                        @endforeach
                    </table>
                </div>

                <div class="form-group">
                    <div id="data">
                      <span>
                          <b>Keterangan : </b>

                          <div style="text-align: justify">
                            {{ $pesanan->keterangan }}<br><br>
                          </div>

                    </div>
                    <div class="col-md-4">
                        <div id="tanggal">

                         <span class="detailSpan" ><h5><b>Subtotal :</b> Rp.{{ number_format($pesanan->total_harga,2,',', '.') }}</h5></span>
                        <input type="hidden" value="{{ $pesanan->total_harga }}" id="totalHarga">
                        <span class="detailSpan" ><h5><b>Bayar :</b> Rp.{{ number_format($jumlahBayar,2,',', '.') }}</h5></span>

                    </div>
                    </div>
                </div>
                 @if ($pesanan->status_bayar == 0)
                    <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Lunas </span></h3><br><br>
                    @elseif($pesanan->status_bayar == 1)
                    {{-- <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Lunas </span></h3><br><br> --}}
                @endif

        <div id="deskripsi">
            <b>Jembar Sari Rasa</b><br>
         Jln Barulaksana No.49 RT.03 RW.14 Jayagiri Lembang Bandung Barat<br>
         +62 821-1912-14111
      </div>

</body>
</html>