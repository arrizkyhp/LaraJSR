@extends('layouts.back.master')

@section('title')
<title>{{ $penyewaan->id_penyewaan }} | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>{{ $penyewaan->id_penyewaan }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                             @if (auth()->user()->role == 0 )
                            <li class="active root-ajj"><a href="{{ asset('admin/dashboard')}}">Dashboard</a> / <a href="{{ asset('admin/penyewaan')}}">Penyewaan</a> / <a href="{{ asset('admin/list_penyewaan')}}">List Penyewaan </a>/ {{ $penyewaan->id_penyewaan }}</li>
                            @elseif(auth()->user()->role == 1 )
                            <li class="active root-ajj"><a href="{{ asset('admin/dashboard')}}">Dashboard</a> / <a href="{{ asset('admin/peralatan_rusak')}}">Peralatan Rusak </a>/ {{ $penyewaan->id_penyewaan }}</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
                    {{-- @if(count($errors) >0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
            @endif

            @if (\Session::has('success'))
            <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
            </div>
            @endif --}}


        <div class="content mt-3">
               <form action="{{ route('sewa.kembali', $penyewaan->id_penyewaan) }}" id="form-submit" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

        <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                         <div style="float:right;">
                            <div class="btn-group" >
                            <a href="{{ route('sewa.email',$penyewaan->id_penyewaan)  }}" class="btn btn-primary" style="float:right;"><i class="fa fa-envelope-o"></i> Email </a>
                            </div>
                            <div class="btn-group" >
                            <a href="https://api.whatsapp.com/send?phone={{ $penyewaan->pelanggan->no_telepon }}&text=Assalamualaikum wr wb, Bapak/Ibu {{ $penyewaan->pelanggan->nama_pelanggan }} berikut ini merupakan Nota Penyewaan anda {{ route('sewa.print',$penyewaan->id_penyewaan)  }}" class="btn btn-primary" style="float:right;"><i class="fa fa-whatsapp"></i> Whatsapp </a>
                            </div>
                            <div class="btn-group" >
                            <a href="{{ route('sewa.print',$penyewaan->id_penyewaan)  }}" class="btn btn-primary" style="float:right;"><i class="fa fa-print"></i> Print </a>
                            </div>
                            </div>
                    </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col-md-6">
                    <span class="detailInfo"><b> Nama Penyewa : </b> {{ $penyewaan->pelanggan->nama_pelanggan }}</span><br>
                    <span class="detailInfo"><b> Alamat : </b> {{ $penyewaan->pelanggan->alamat }}</span><br>
                    <span class="detailInfo"><b> Operator : </b> {{ $penyewaan->users->name }}</span><br><br>
                </div>
            <div class="col-md-6">
                <div class="form-group">
                    <span  style="margin-right:5px; float:right;"><b> Tanggal Pesan: </b> {{ date('d/m/Y', strtotime($penyewaan->tanggal_penyewaan)) }}</span><br>
                    <span   style="margin-right:5px; float:right;"><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($penyewaan->tanggal_akhir)) }}</span><br>
                    @if ($penyewaan->status_penyewaan == 0)
                        @if ($penyewaan->tanggal_akhir < $pengembalian->tanggal_kembali)
                            <span style="margin-right:5px; float:right; color:red;"><b> Tanggal Kembali : </b> {{ date('d/m/Y', strtotime($pengembalian->tanggal_kembali)) }}</span><br><br>
                            @elseif ($penyewaan->tanggal_akhir >= $pengembalian->tanggal_kembali)
                            <span style="margin-right:5px; float:right;"><b> Tanggal Kembali : </b> {{ date('d/m/Y', strtotime($pengembalian->tanggal_kembali)) }}</span><br><br>
                        @endif

                    @endif
                     <input type="hidden" style="date" id="tanggal_akhir" value="{{ $penyewaan->tanggal_akhir }}" name="tanggal_akhir">
                    {{-- Status Pesanan --}}
                    {{-- @if ($penyewaan->status_penyewaan == 0)
                    <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Selesai </span></h3><br><br>
                    @elseif($penyewaan->status_penyewaan == 1)
                    <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Selesai </span></h3><br><br>
                    @endif --}}
                    {{-- Status Bayar --}}
                    <br>
                    @if ($penyewaan->status_bayar == 0)
                    <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Lunas </span></h3><br><br>
                    @elseif($penyewaan->status_bayar == 1)
                    <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Lunas </span></h3><br><br>
                    @endif
               </div>
            </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <thead>
                            <th>Nama Perlengkapan</th>
                            <th>Jumlah Perlengkapan</th>
                            <th>Satuan</th>
                            <th>Harga Sewa Satuan</th>
                            <th>Jumlah</th>
                        </thead>
                    </tr>
                    <tr>
                        <tbody>
                            @foreach ($detail as $details)
                            <td>{{ $details->peralatan->nama_peralatan}}</td>
                            <td><input type="hidden" value="{{ $details->jumlah_sewa}}" name="jumlah_sewa[]">{{ $details->jumlah_sewa}}</td>
                            <td>{{ $details->peralatan->satuan->nama_satuan}}</td>
                            <td>Rp.{{ number_format($details->peralatan->harga_sewa,0,',', '.') }}</td>
                            <td>Rp.{{ number_format($details->subtotal,0,',', '.') }}</td>


                        </tbody>
                    </tr>
                      @endforeach
                </table>
            </div>

                 <div class="form-group">
                    <div class="col-md-8">
                      <span>
                          <b>Keterangan : </b>

                          <div style="text-align: justify">
                            {{ $penyewaan->keterangan }}<br><br>
                          </div>

                    </div>
                    <div class="col-md-4">

                         @if ($penyewaan->status_penyewaan == 0)
                                <span class="detailSpan" ><h4><b>Subtotal :</b> Rp.{{ number_format($penyewaan->total_harga,0,',', '.') }}</h4></span>
                                <input type="hidden" value="{{ $penyewaan->total_harga }}" id="subtotal" name="subtotal">
                                <hr>
                                <div class="form-group">
                                    @if ($pengembalian->total_denda > 0)
                                        <span class="detailSpan" ><h4 style="color:red;"><b>Total Denda :</b> Rp.<span class="dendaTotal">{{ number_format($pengembalian->total_denda,0,',', '.') }}</span></h4></span>
                                    @elseif ($pengembalian->total_denda == 0)
                                    <span class="detailSpan" ><h4><b>Total Denda :</b> Rp.<span class="dendaTotal">{{ number_format($pengembalian->total_denda,0,',', '.') }}</span></h4></span>
                                    @endif

                                <input type="hidden" class="total_denda" name="total_denda">
                                <span class="detailSpan"><h4><b>Total Bayar :</b> Rp.<span id="total_bayar">{{ number_format($penyewaan->total_bayar,0,',', '.') }}</span></h4></span>

                                </div>
                                @elseif  ($penyewaan->status_penyewaan == 1)
                                <span class="detailSpan" ><h4><b>Subtotal :</b> Rp.{{ number_format($penyewaan->total_harga,0,',', '.') }}</h4></span>
                                <input type="hidden" value="{{ $penyewaan->total_harga }}" id="subtotal" name="subtotal">
                                <span class="detailSpan" ><h4><b>Bayar :</b> Rp.{{ number_format($penyewaan->bayar,0,',', '.') }}</h4></span>
                                <hr>
                                <span class="detailSpan" ><h4><b>Sisa :</b> Rp.{{ number_format($penyewaan->total_harga - $penyewaan->bayar,0,',', '.') }}</h4></span>

                                @endif

                    </div>
                </div>
                 <div class="col-md-6">
                     @if ($penyewaan->status_penyewaan == 0)

                     @elseif ($penyewaan->status_penyewaan == 1 && $penyewaan->status_alat == 0)
                       <button type="button" class="btn btn-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pengembalian</b>
                    @else
                         <h3><span class="badge badge-info" style="margin-right:5px;" > Menunggu Konfirmasi  </span></h3>
                     @endif

                </div>
                <div class="col-md-6">

                    @if  (!$peralatanRusak->isEmpty())
                         <button type="button" style="margin-right:5px; float:right;" class="btn btn-danger" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Rincian Denda</b>
                    @endif
                </div>

                     </div>
            </div>

        </div> <!-- .content -->
         <div class="col-lg-12">
           <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <input type="hidden" id="id_menu">
                            <div class="form-group col-md-7">
                                <div class="form-group">
                                    <h3>Barang Kembali</h3>

                                </div>
                                <div class="table-responsive">
                                    <table id="table-kembali" class="table table-striped table-bordered table-kembali">
                                        <tr>
                                            <thead>
                                                <th>Nama Perlengkapan</th>
                                                <th>Kembali</th>
                                                <th>Tidak Kembali / Rusak</th>
                                                <th>Harga Ganti (jika rusak)</th>
                                                <th>Denda</th>
                                                <th style='display:none;'>a</th>
                                            </thead>
                                        </tr>
                                        <tbody>

                                            @if ($penyewaan->status_penyewaan == 0)



                                            @elseif($penyewaan->status_penyewaan == 1)

                                            @foreach ($detail as $details)
                                                <tr>
                                                <td><input type="hidden" >{{ $details->peralatan->nama_peralatan}}</td>
                                                <td><input type="number" min="0" name="jumlah_kembali[]" value="{{ $details->jumlah_sewa}}" class="form-control jumlah_kembali"></td>
                                                <td><input type="hidden" name="jumlah_rusak[]" id="jumlah_rusak"><span class="tidak_kembali">0</span></td>
                                                <td>{{ number_format($details->peralatan->harga_ganti,0,',', '.') }}</td>
                                                <td class="denda_kembali" >0</td>
                                                <td style='display:none;'>{{ $details->peralatan->harga_sewa }}</td>
                                                <td style='display:none;'>{{ $details->jumlah_sewa }}</td>
                                                <td style='display:none;'><span class="ganti_harga">{{ $details->peralatan->harga_ganti }}</span></td>
                                                <td style='display:none;'><input type="hidden" name="id_detail_penyewaan[]" value="{{ $details->id_detail_penyewaan }}"></td>
                                                </tr>
                                            @endforeach


                                            @endif


                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="form-group col-md 1"></div>
                            <span class="form-group col-md-4">
                                <label for="">Tanggal Kembali</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="date" id="tanggal_kembali" class="form-control" name="tanggal_kembali" value="{{  date('Y-m-d') }}">
                                </div><br>

                                    <input type="hidden" value="{{ $penyewaan->total_harga }}" id="totalHarga">

                                    <input type="hidden" id="bayar" value="{{ $penyewaan->bayar }}">
                                    <span class="detailSpan" ><h4><b>Denda Ganti :</b> Rp.<span class="dendaGanti">{{ number_format(0,0,',', '.') }}</span></h4></span>
                                    <input type="hidden" class="denda_ganti" name="denda_ganti">
                                    <span class="detailSpan" ><h4><b>Denda Telat :</b> Rp.<span class="dendaTelat">{{ number_format(0,0,',', '.') }}</span></h4></span>
                                    <input type="hidden" class="denda_telat" name="denda_telat">
                                 <hr>
                                 <div class="form-group">
                                    <span class="detailSpan" ><h4 ><b>Total Denda :</b> Rp.<span class="dendaTotal">{{ number_format(0,0,',', '.') }}</span></h4></span>
                                    <input type="hidden" class="total_denda" name="total_denda">
                                    <span class="detailSpan"><h4><b>Total Bayar :</b> Rp.<span id="total_bayar">{{ number_format($penyewaan->total_harga-$penyewaan->bayar,0,',', '.') }}</span></h4></span>
                                    <span class="detailSpan" ><h4><b>Nominal Bayar :</b> Rp.<span id="bayar_nominal">0</span></h4></span><br>
                                    <input type="hidden" value="{{ $penyewaan->id_penyewaan }}" name="id_penyewaan">
                                    <input type="hidden" value="{{ $penyewaan->bayar }}" name="bayar_dp">
                                    <input type="number" name="bayar_lagi" id="bayar_lagi" class="form-control bayar" value="{{ $penyewaan->total_harga-$penyewaan->bayar }}"  placeholder="Masukkan Jumlah Bayar" ><br>
                                    <button type="submit" value="submit" class="btn btn-primary btn_simpan_kembali" style="margin-right:5px; float:right;">Simpan</button>

                                </div>
                            </div>

                    </div>

                    </div>
                </div>

                {{-------------------------------- Rincian Denda ----------------------------}}

                 <div class="collapse multi-collapse" id="multiCollapseExample2">
                     <div class="col-lg-6"></div>
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <input type="hidden" id="id_menu">

                             @if  ($pengembalian != null )

                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Barang Rusak/Tidak Kembali</strong>

                                </div>
                                <div class="table-responsive">
                                    <table id="table-kembali" class="table table-striped table-bordered table-kembali">
                                        <tr>
                                            <thead>
                                                <th>Nama Perlengkapan</th>
                                                <th>Jumlah</th>
                                                <th>Denda</th>
                                                <th style='display:none;'>a</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($peralatanRusak as $rusak)
                                                <tr>
                                                    <td>{{ $rusak->peralatan->nama_peralatan }}</td>
                                                    <td>{{ $rusak->jumlah_rusak }}</td>
                                                    <td style="text-align:right;">Rp.{{ number_format($rusak->peralatan->harga_ganti * $rusak->jumlah_rusak,0,',', '.') }}</td>
                                                </tr>
                                                @endforeach
                                                <td colspan="2"><b>Denda Ganti</b></td>
                                                <td style="color:red; text-align:right;">Rp.<span class="dendaGanti">{{ number_format($pengembalian->denda_ganti,0,',', '.') }}</span></td>


                                            </tbody>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                             <span class="form-group col-md-12">
                                    <span class="detailSpan" ><h4><b>Denda Telat :</b><span class="dendaTelat" style="color:red;"> Rp.{{ number_format($pengembalian->denda_telat,0,',', '.') }}</span></h4></span>
                            </span>
                            @endif
                            </div>

                    </div>

                    </div>
                    </div>
                </div>
            </div>
        </form>
         </div>
    </div><!-- /#right-panel -->


    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')
    <script src="{{ asset('vendors/autonumeric/jquery.number.min.js') }}"></script>
     <script src="{{ asset('vendors/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
    <script type="text/javascript">


    $(document).ready(function () {


          $(document).on('click','.btn-simpan',function (e) {
              $('#formTambah').attr('action','/admin/bayar');
          });

          $('#bayar_lagi').on('change',function(){

            var qty = $(this).val();
            //  Ketika Quantity diisi -1

            if (qty<1) {
            qty=1;

            }
         $('#bayar_lagi').val(qty);
          $('#bayar_nominal').html(qty).formatCurrency();


    });
        // ketika tanggal kembali di ganti
            $("#tanggal_kembali").on("change", function(e) {
                tanggalKembali();
            });

        $('.btn_simpan_kembali').click(function(){
            var bayar = $("#bayar_lagi").val();

            if(bayar == '') {
                alertBayar();
                return false;
            }else {
                return true;
            }


        });




    $('.table-kembali').on('change','.jumlah_kembali',function(e){
            $(this).closest('tr').find("input").each(function() {
                var id = $(this).val();


                //  $('.bayar').val(id);
                // Menghitung Baris Kembali
                var currow = $(this).closest('tr');
                var stock = currow.find('td:eq(6)').text();
                 var ids = currow.find('td:eq(1)').find("input").val();

                if(parseInt(ids) > parseInt(stock))
                {
                    currow.find('td:eq(1)').find("input").val(parseInt(stock));
                }
                var jumlahPerlengkapan = currow.find('td:eq(1)').find("input").val();
                var jumlahSewa = currow.find('td:eq(6)').text();
                var hargaGanti = currow.find('td:eq(7)').text();
                // var result = col4+'\n'+col2;
                var tidakKembali = jumlahSewa - jumlahPerlengkapan;
                var denda = tidakKembali * hargaGanti;
                currow.find('td:eq(2)').text(tidakKembali);
                currow.find('td:eq(4)').text(denda);
                grandtotal();






            });

    });

            function tanggalKembali()
            {
                    var start = $('#tanggal_akhir').val();
                        var end = $('#tanggal_kembali').val();

                        // end - start returns difference in milliseconds
                        var diff = new Date(Date.parse(end) - Date.parse(start));

                        // get days
                        var days = diff/1000/60/60/24;
                        var hari = Math.round(days);
                        // jika hari kurang dari tanggal ketententuan kembali ke 0
                        if (hari <= 0) {
                            var hari = 0;
                        }
                        var denda = 50000;
                        var telat = parseInt(hari) * parseInt(denda);
                        $('.dendaTelat').html(telat).formatCurrency();
                        var subtotal = $("#subtotal").val();
                        var bayar = $("#bayar").val();

                        var ganti = $(".dendaGanti").html();
                        var ganti = ganti.replace(".", '');

                        var DendaTotal = parseInt(ganti) + parseInt(telat);
                        var grandtotal = parseInt(DendaTotal) + parseInt(subtotal) - parseInt(bayar) ;

                        $('.dendaTotal').html(DendaTotal).formatCurrency();
                        $('.total_denda').val(DendaTotal);
                        $('.denda_ganti').val(ganti);
                        $('.denda_telat').val(telat);
                        $('#total_bayar').html(grandtotal).formatCurrency();
                        $('#bayar_lagi').val(grandtotal);


            }

            function grandtotal()
            {
                var sum = 0;
                $('.denda_kembali').each(function(){
                    var q = parseInt($(this).html());

                    sum += parseInt(q);
                // test += $('.subtotal).val(col2);
            });
            //   alert(sum);
                var subtotal = $("#subtotal").val();
                var bayar = $("#bayar").val();
                var telat = $(".dendaTelat").html();
                var telat = telat.replace(".", '');

                $('.dendaGanti').html(sum).formatCurrency();
                var ganti = $('.dendaGanti').html().replace(/[^\d,-]/g, '');
                var ganti = ganti.replace(",", '');

                // $('.dendaTelat').html(sum).formatCurrency();
                // var telat = $('.dendaTelat').html().replace(/[^\d,-]/g, '');


                var DendaTotal = parseInt(ganti) + parseInt(telat);
                var grandtotal = parseInt(DendaTotal) + parseInt(subtotal) - parseInt(bayar) ;

                $('.dendaTotal').html(DendaTotal).formatCurrency();
                $('.total_denda').val(DendaTotal);
                $('.denda_ganti').val(ganti);
                $('.denda_telat').val(telat);
                $('#total_bayar').html(grandtotal).formatCurrency();
                 $('#bayar_lagi').val(grandtotal);


                //  $('.total_harga').val(raw);
            }


           $('#test').click(function() {

            });

             function alertBayar (){
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Isi Jumlah Bayar Terlebih Dahulu!',

            });
          }

});
</script>

    @endpush

@extends('pesanan.list.form')


