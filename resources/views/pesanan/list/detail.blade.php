@extends('layouts.back.master')

@section('title')
<title>{{ $pesanan->id_pesanan }} | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>{{ $pesanan->id_pesanan }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="{{ asset('admin/dashboard')}}">Dashboard</a> / <a href="{{ asset('admin/pesanan')}}">Pesanan</a> / <a href="{{ asset('admin/list_pesanan')}}"">List Pesanan </a>/ {{ $pesanan->id_pesanan }}</li>
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
                          <div class="card-header">
                         <a href="{{ route('pesanan.print',$pesanan->id_pesanan)  }}" class="btn btn-primary" style="float:right;"><i class="fa fa-print"></i> Print </a>
                    </div>
              <div class="card-body">
                  <div class="form-group">
                      <div class="col-md-6">
              <span class="detailInfo"><b> Nama Pemesan : </b> {{ $pesanan->pelanggan->nama_pelanggan }}</span><br>
              <span class="detailInfo"><b> Alamat : </b> {{ $pesanan->pelanggan->alamat }}</span><br>

              <span class="detailInfo"><b> Operator : </b> {{ $pesanan->user->name }}</span><br><br>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                        <span  style="margin-right:5px; float:right;"><b> Tanggal Pesan: </b> {{ date('d/m/Y', strtotime($pesanan->tanggal)) }}</span><br>
                        <span   style="margin-right:5px; float:right;"><b> Untuk Tanggal : </b> {{ date('d/m/Y', strtotime($pesanan->tanggal_pesanan)) }}</span><br>
                        @if ($pesanan->status_bayar == 0)
                        <span   style="margin-right:5px; float:right;"><b> Tanggal Pelunasan : </b> {{ date('d/m/Y', strtotime($tanggalBayar->tanggal_bayar)) }}</span><br><br>
                        @endif
              {{-- Status Pesanan --}}
              @if ($pesanan->status_pesanan == 0)
              <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Selesai </span></h3><br><br>
              @elseif($pesanan->status_pesanan == 1)
               <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Selesai </span></h3><br><br>
              @endif
              {{-- Status Bayar --}}
              @if ($pesanan->status_bayar == 0)
              <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Lunas </span></h3><br><br>
                @elseif($pesanan->status_bayar == 1)
                <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Lunas </span></h3><br><br>
              @endif
               </div>
            </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <thead>
                                <th>Nama Menu</th>
                                <th>Deskripsi</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </thead>
                        </tr>
                        <tr>
                            <tbody>
                                @foreach ($detail as $details)
                                <td>{{ $details->menu->nama_menu}}</td>
                                <td>
                                @foreach ($details->menu->detail_menu as $detail_m)
                                    <label for="" class="badge badge-info">{{ $detail_m->list_makanan->nama_makanan }}</label>
                                @endforeach</td>
                                <td>{{ $details->quantity}}</td>
                                <td>{{ $details->harga}}</td>
                                <td>{{ $details->subtotal}}</td>

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
                            {{ $pesanan->keterangan }}
                          </div>
                      </span>

                    </div>
                    <div class="col-md-4">
                        <span class="detailSpan" ><h4><b>Subtotal :</b> Rp.{{ number_format($pesanan->total_harga,2,',', '.') }}</h4></span>
                        <input type="hidden" value="{{ $pesanan->total_harga }}" id="totalHarga">
                        <span class="detailSpan" ><h4><b>Bayar :</b> Rp.{{ number_format($jumlahBayar,2,',', '.') }}</h4></span>
                        <hr>
                        <span class="detailSpan"><h4><b>Sisa :</b> Rp.{{ number_format($pesanan->total_harga- $jumlahBayar,2,',', '.') }}</h4></span><br>

                    </div>
                    <div class="col-md-6">
                     @if ($prasmananStatus != null)
                       <button type="button" class="btn btn-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Peralatan</b>
                     @endif

                    </div>
                    <div class="col-md-6">
                         @if ($pesanan->status_bayar != 0)
                        <button class="btn btn-primary" style="margin-right:5px; float:right;" data-toggle="modal" data-target="#exampleModal">Bayar</button>
                        @endif
                         <button type="button"  style="margin-right:5px; float:right;" class="btn btn-info" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">History Bayar</b>
                    </div>
                </div>
                </div>
            </div>

        </div> <!-- .content -->
        <div class="col-lg-6">
           <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <input type="hidden" id="id_menu">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <h3>Peralatan</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="table-kembali" class="table table-striped table-bordered table-kembali">
                                        <tr>
                                        <thead>
                                                <th>Nama Peralatan</th>
                                                <th>Jumlah Peralatan</th>
                                                <th style='display:none;'>a</th>
                                            </thead>
                                        </tr>
                                        <tbody>

                                            @foreach ($prasmanan as $p)
                                                <tr>
                                                {{-- <td><input type="hidden" >{{ $details->peralatan->nama_peralatan}}</td>ss --}}
                                                <td>{{ $p->peralatan->nama_peralatan }}</td>
                                                <td>{{ $p->jumlah_peralatan }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="form-group col-md 1"></div>

                    </div>

                    </div>
                </div>
            </div>
    </div><!-- /#right-panel -->
     <div class="col-lg-6">
           <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <input type="hidden" id="id_menu">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <h3>History Bayar</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="table-kembali" class="table table-striped table-bordered table-kembali">
                                        <tr>
                                        <thead>
                                                <th>Tanggal Bayar</th>
                                                <th>Bayar</th>
                                                <th>Keterangan</th>
                                                <th style='display:none;'>a</th>
                                            </thead>
                                        </tr>
                                        <tbody>

                                            @foreach ($bayar as $b)
                                                <tr>
                                                {{-- <td><input type="hidden" >{{ $details->peralatan->nama_peralatan}}</td>ss --}}
                                                <td>{{ date('d/m/Y', strtotime($b->tanggal_bayar)) }}</td>
                                                <td style="text-align: right;">Rp.{{ number_format($b->bayar,0,',', '.') }}</td>
                                                <td>{{ $b->keterangan }}</td>
                                                </tr>
                                            @endforeach
                                            <td>Jumlah</td>
                                            <td style="text-align: right;">Rp.{{ number_format($jumlahBayar,0,',', '.') }}</td>
                                            <td></td>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="form-group col-md 1"></div>

                    </div>

                    </div>
                </div>
            </div>
    </div><!-- /#right-panel -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bayar Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('/admin/bayar') }}" method="POST" id="formTambah">

                        {{ csrf_field() }}
                        <div class="form-group">
                             <label for="">Tanggal Bayar</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="date" id="tanggal_bayar" class="form-control" name="tanggal_bayar" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            Nominal
                            <div style="text-align: right;">
                                <h2 >Rp.<b><span id="bayar_nominal">{{ number_format('0') }}</span></b></h2>
                            </div>
                            <input type="hidden" value="{{ $pesanan->id_pesanan }}" name="id_pesanan">
                            <input type="hidden" value="{{ $pesanan->total_harga }}" name="total_harga">
                            <label for="nama_pelanggan">Bayar</label>
                            <input type="number" name="bayar_lagi" id="bayar_lagi" class="form-control bayar"  placeholder="Masukkan Jumlah Bayar" >

                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                  </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
            </form>
            </div>
    </div>
    </div>

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


    });
</script>

    @endpush

@extends('pesanan.list.form')


