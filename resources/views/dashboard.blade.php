@extends('layouts.back.master')

@section('title')
<title>Dashboard | Jembar Sari Rasa</title>
@endsection
@push('script')

<script src="{{ asset('vendors/chart.js/dist/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/widgets.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script>

$(document).on('ajaxComplete ready', function () {
    $('.modalMd').off('click').on('click', function () {
        $('#modalMdContent').load($(this).attr('value'));
        $('#modalMdTitle').html($(this).attr('title'));
    });
});
</script>

@endpush

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">


            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-shopping-cart text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Pesanan </div>
                                    <div class="stat-text">Selesai: {{ $users = DB::table('t_pesanan')->where('status_pesanan',0)->count() }}</div>
                                    <div class="stat-text">Belum: {{ $users = DB::table('t_pesanan')->where('status_pesanan',1)->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-briefcase text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Penyewaan </div>
                                    <div class="stat-text">Selesai: {{ $users = DB::table('t_penyewaan')->where('status_penyewaan',0)->count() }}</div>
                                    <div class="stat-text">Belum: {{ $users = DB::table('t_penyewaan')->where('status_penyewaan',1)->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-user text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Pelanggan </div>
                                    <div class="stat-text">Total: {{ $users = DB::table('t_pelanggan')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-clipboard text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Menu </div>
                                    <div class="stat-text">Total: {{ $users = DB::table('t_menu')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--/.col-->
               @if (auth()->user()->role == 1 )
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                <strong class="card-title mb-3">Pesanan yang membutuhkan Peralatan</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                     <th>Kode Pesanan</th>
                                    <th>Tanggal Input</th>
                                    <th>Untuk Tanggal</th>
                                    <th>List Peralatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan as $pesan)
                                <tr>
                                    <td>{{ $pesan->id_pesanan }}</td>
                                    <td>{{ date('d/m/Y', strtotime($pesan->tanggal  )) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($pesan->tanggal_pesanan ))  }}</td>
                                     <td>
                                        @foreach ($pesan->prasmanan as $pras)
                                         <span class="badge badge-success">{{ $pras->peralatan->nama_peralatan }} : {{ $pras->jumlah_peralatan }}</span>
                                        @endforeach
                                        </td>
                                        <td><a href="{{route('pesanan.peralatan',$pesan->id_pesanan)}}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a></td>
                                </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                <strong class="card-title mb-3">Penyewaan yang membutuhkan Peralatan</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Penyewaan</th>
                                    <th>Tanggal Input</th>
                                    <th>Sampai Tanggal</th>
                                    <th>List Peralatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penyewaan as $sewa)
                                <tr>
                                    <td>{{ $sewa->id_penyewaan}}</td>
                                    <td>{{ date('d/m/Y', strtotime($sewa->tanggal_penyewaan  )) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($sewa->tanggal_akhir ))  }}</td>
                                     <td>
                                        @foreach ($sewa->detail_penyewaan as $pras)
                                         <span class="badge badge-success">{{ $pras->peralatan->nama_peralatan }} : {{ $pras->jumlah_sewa }}</span>
                                        @endforeach
                                        </td>
                                        <td><a href="{{route('sewa.peralatan',$sewa->id_penyewaan)}}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a></td>
                                </tr>

                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            </div>
             @endif





        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection