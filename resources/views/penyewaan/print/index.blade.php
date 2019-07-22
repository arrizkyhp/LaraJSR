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



      <h4><b>{{ $penyewaan->id_penyewaan }}</b></h4>

                <div id="data">
                    <span class="detailInfo"><b> Nama Penyewa : </b> {{ $penyewaan->pelanggan->nama_pelanggan }}</span><br>
                    <span class="detailInfo"><b> Alamat : </b> {{ $penyewaan->pelanggan->alamat }}</span><br>
                    <span class="detailInfo"><b> Operator : </b> {{ $penyewaan->users->name }}</span>
                </div>
            <div id="tanggal">
                    <span  ><b> Tanggal Pesan: </b> {{ date('d/m/Y', strtotime($penyewaan->tanggal_penyewaan)) }}</span><br>
                    <span ><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($penyewaan->tanggal_akhir)) }}</span><br>
                    @if ($penyewaan->status_penyewaan == 1)

                    @else
                         <span ><b> Tanggal Kembali : </b> {{ date('d/m/Y', strtotime($pengembalian->tanggal_kembali)) }}</span>
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
                            <th>Nama Perlengkapan</th>
                            <th>Jumlah Perlengkapan</th>
                            <th>Satuan</th>
                            <th>Harga Sewa Satuan</th>
                            <th>Jumlah</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                            @foreach ($detail as $details)
                            <td>{{ $details->peralatan->nama_peralatan}}</td>
                            <td><input type="hidden" value="{{ $details->jumlah_sewa}}" name="jumlah_sewa[]">{{ $details->jumlah_sewa}}</td>
                            <td>{{ $details->peralatan->satuan->nama_satuan}}</td>
                            <td>Rp.{{ number_format($details->peralatan->harga_sewa,0,',', '.') }}</td>
                            <td>Rp.{{ number_format($details->subtotal,0,',', '.') }}</td>
                              </tr>
                        </tbody>

                      @endforeach
                </table>
                <div class="form-group">
                    <div id="data">
                      <span>
                          <b>Keterangan : </b>

                          <div style="text-align: justify">
                            {{ $penyewaan->keterangan }}<br><br>
                          </div>

                    </div>
                    <div class="col-md-4">
                        <div id="tanggal">

                         @if ($penyewaan->status_penyewaan == 0)
                                <span class="detailSpan" ><h5><b>Subtotal :</b> Rp.{{ number_format($penyewaan->total_harga,0,',', '.') }}</h5></span>
                                <input type="hidden" value="{{ $penyewaan->total_harga }}" id="subtotal" name="subtotal">

                                <div class="form-group">
                                    @if ($pengembalian->total_denda > 0)
                                        <span class="detailSpan" ><h5 style="color:red;"><b>Total Denda :</b> Rp.<span class="dendaTotal">{{ number_format($pengembalian->total_denda,0,',', '.') }}</span></h5></span>
                                    @elseif ($pengembalian->total_denda == 0)
                                        <span class="detailSpan" ><h5><b>Total Denda :</b> Rp.<span class="dendaTotal">{{ number_format($pengembalian->total_denda,0,',', '.') }}</span></h5></span>
                                    @endif

                                <input type="hidden" class="total_denda" name="total_denda">
                                <span class="detailSpan"><h5><b>Total Bayar :</b> Rp.<span id="total_bayar">{{ number_format($penyewaan->total_bayar,0,',', '.') }}</span></h5></span>

                                </div>
                                @elseif  ($penyewaan->status_penyewaan == 1)
                                <span class="detailSpan" ><h5><b>Subtotal :</b> Rp.{{ number_format($penyewaan->total_harga,0,',', '.') }}</h5></span>
                                <input type="hidden" value="{{ $penyewaan->total_harga }}" id="subtotal" name="subtotal">
                                <span class="detailSpan" ><h5><b>DP :</b> Rp.{{ number_format($penyewaan->bayar,0,',', '.') }}</h5></span><br>

                                @endif

                    </div>
                    </div>
                 <table>
                     <tr>
                        <td width="50%">

                        <span class="detailInfo"><b> Tanda Terima </b></span><br><br><br>
                        <span class="detailInfo"><b> ......................... </b></span><br>
                        </td>
                        <td></td>
                        <td width="50%">
                             <div id="tanggal">
                        <span class="detailInfo"><b> Hormat Kami </b></span><br><br><br>
                        <span class="detailInfo"><b> Hj. M. Siti Aminah </b></span><br>
                             </div>

                        </td>
                         </tr>
                </table><br><br>

        <div id="deskripsi">
            <b>Jembar Sari Rasa</b><br>
         Jln Barulaksana No.49 RT.03 RW.14 Jayagiri Lembang Bandung Barat<br>
         +62 821-1912-14111
      </div>

</body>
</html>