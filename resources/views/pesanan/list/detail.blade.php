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
              <span   style="margin-right:5px; float:right;"><b> Tanggal Pemesanan : </b> {{ date('d/m/Y', strtotime($pesanan->tanggal_pesanan)) }}</span><br><br>
              @if ($pesanan->status == 0)
              <h3><span class="badge badge-success" style="margin-right:5px; float:right;"> Lunas </span></h3><br><br>
                @elseif($pesanan->status == 1)
                <h3><span class="badge badge-danger" style="margin-right:5px; float:right;" > Belum Lunas </span></h3><br><br>

              @endif
               </div>
            </div>
                </div>

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
                    <span class="detailSpan" ><h4><b>Bayar :</b> Rp.{{ number_format($pesanan->bayar,2,',', '.') }}</h4></span>
                    <hr>
                    <span class="detailSpan"><h4><b>Sisa :</b> Rp.{{ number_format($pesanan->total_harga-$pesanan->bayar,2,',', '.') }}</h4></span>
                    </div>
                </div>
                     </div>
            </div>

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')
    <script type="text/javascript">

    $(document).ready(function () {
         $('body').toggleClass('open');



    });
</script>

    @endpush

@extends('pesanan.list.form')


