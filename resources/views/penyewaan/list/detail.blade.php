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
                            <li class="active root-ajj"><a href="{{ asset('admin/dashboard')}}">Dashboard</a> / <a href="{{ asset('admin/penyewaan')}}">Penyewaan</a> / <a href="{{ asset('admin/list_penyewaan')}}">List Penyewaan </a>/ {{ $penyewaan->id_penyewaan }}</li>
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

        <div class="col-lg-12">
                <div class="card">
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
                    <span   style="margin-right:5px; float:right;"><b> Sampai Tanggal : </b> {{ date('d/m/Y', strtotime($penyewaan->tanggal_akhir)) }}</span><br><br>
                    {{-- Status Pesanan --}}
                    @if ($penyewaan->status_penyewaan == 0)
                    <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Selesai </span></h3><br><br>
                    @elseif($penyewaan->status_penyewaan == 1)
                    <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Selesai </span></h3><br><br>
                    @endif
                    {{-- Status Bayar --}}
                    @if ($penyewaan->status_bayar == 0)
                    <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Lunas </span></h3><br><br>
                    @elseif($penyewaan->status_bayar == 1)
                    <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Lunas </span></h3><br><br>
                    @endif
               </div>
            </div>
            </div>

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
                            <td>{{ $details->jumlah_sewa}}</td>
                            <td>{{ $details->peralatan->satuan}}</td>
                            <td>Rp.{{ number_format($details->peralatan->harga_sewa,0,',', '.') }}</td>
                            <td>Rp.{{ number_format($details->subtotal,0,',', '.') }}</td>


                        </tbody>
                    </tr>
                      @endforeach
                </table>

                 <div class="form-group">
                    <div class="col-md-8">
                      <span>
                          <b>Keterangan : </b>
                          <div style="text-align: justify">
                            {{ $penyewaan->keterangan }}<br><br>
                          </div>

                    </div>
                    <div class="col-md-4">
                        <span class="detailSpan" ><h4><b>Subtotal :</b> Rp.{{ number_format($penyewaan->total_harga,2,',', '.') }}</h4></span>
                        <input type="hidden" value="{{ $penyewaan->total_harga }}" id="subtotal">

                    </div>
                </div>
                 <div class="col-md-6">
                    <button type="button" class="btn btn-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pengembalian</b>
                </div>
                <div class="col-md-6">

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
                            <div class="form-group col-md-8">
                                <div class="form-group">
                                    <h3>Barang Kembali</h3>
                                </div>

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

                                            @foreach ($detail as $details)
                                              <tr>
                                            <td>{{ $details->peralatan->nama_peralatan}}</td>
                                            <td><input type="number" min="0" name="jumlah_kembali[]" value="{{ $details->jumlah_sewa}}" class="form-control jumlah_kembali"></td>
                                            <td><span class="tidak_kembali">0</span></td>
                                            <td>{{ number_format($details->peralatan->harga_ganti,0,',', '.') }}</td>
                                            <td class="denda_kembali" >0</td>
                                            <td style='display:none;'>{{ $details->peralatan->harga_sewa }}</td>
                                            <td style='display:none;'>{{ $details->jumlah_sewa }}</td>
                                            <td style='display:none;'><span class="ganti_harga">{{ $details->peralatan->harga_ganti }}</span></td>
                                             </tr>
                                          @endforeach

                                    </tbody>

                                </table>
                            </div>
                            <div class="form-group col-md 1"></div>
                            <span class="form-group col-md-3">
                                <label for="">Tanggal Kembali</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input type="date" id="tanggal_kembali" class="form-control" name="tanggal_kembali" value="{{ date('Y-m-d') }}">
                                </div><br>

                                <input type="hidden" value="{{ $penyewaan->total_harga }}" id="totalHarga">
                                <span class="detailSpan" ><h4><b>Bayar :</b> Rp.{{ number_format($penyewaan->bayar,0,',', '.') }}</h4></span>
                                <input type="hidden" id="bayar" value="{{ $penyewaan->bayar }}">
                                 <span class="detailSpan" ><h4><b>Denda :</b> Rp.<span class="dendaTotal">{{ number_format(0,0,',', '.') }}</span></h4></span>
                                 <hr>
                                 <div class="form-group">
                                    <span class="detailSpan"><h4><b>Total Bayar :</b> Rp.<span id="total_bayar">0</span></h4></span>
                                    <span class="detailSpan" ><h4><b>Nominal Bayar :</b> Rp.<span id="bayar_nominal">0</span></h4></span><br>
                                    <input type="hidden" value="{{ $penyewaan->id_penyewaan }}" name="id_penyewaan">
                                    <input type="hidden" value="{{ $penyewaan->bayar }}" name="total_harga">
                                    <input type="number" name="bayar_lagi" id="bayar_lagi" class="form-control bayar"  placeholder="Masukkan Jumlah Bayar" ><br>
                                    <button class="btn btn-primary" style="margin-right:5px; float:right;" data-toggle="modal" data-target="#exampleModal">Simpan</button>

                                </div>
                            </div>

                    </div>

                    </div>
                </div>
            </div>
         </div>
    </div><!-- /#right-panel -->


    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')
    <script src="{{ asset('vendors/autonumeric/jquery.number.min.js') }}"></script>
     <script src="{{ asset('vendors/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
    <script type="text/javascript">


    $(document).ready(function () {
         $('body').toggleClass('open');

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

            $('.dendaTotal').html(sum).formatCurrency();
            var raw = $('.dendaTotal').html().replace(/[^\d,-]/g, '');
            var raw = raw.replace(",", '');

            var grandtotal = parseInt(raw) + parseInt(subtotal) - parseInt(bayar) ;

            $('#total_bayar').html(grandtotal).formatCurrency();


            //  $('.total_harga').val(raw);
          }
});
</script>

    @endpush

@extends('pesanan.list.form')


