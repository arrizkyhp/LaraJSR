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


            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">{{ $users = DB::table('t_pesanan')->where('status_pesanan',0)->count() }}</span>
                        </h4>
                        <p class="text-light">Pesanan Selesai</p>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">

                        <h4 class="mb-0">
                            <span class="count">{{ $users = DB::table('t_penyewaan')->where('status_penyewaan',0)->count() }}</span>
                        </h4>
                        <p class="text-light">Penyewaan Selesai</p>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">

                        <h4 class="mb-0">
                            <span class="count">{{ $users = DB::table('t_pesanan')->where('status_pesanan',1)->count() }}</span>
                        </h4>
                        <p class="text-light">Pesanan Belum Selesai</p>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Members online</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->
               @if (auth()->user()->role == 1 )
            <div class="col-md-6">
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
             @endif





        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection