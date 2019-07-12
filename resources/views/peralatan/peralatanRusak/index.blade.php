@extends('layouts.back.master')

@section('title')
<title>Peralatan | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-7 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Peralatan Rusak/Tidak Kembali</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="/admin/pesanan">Dashboard</a> /<a href="/admin/peralatan"> Peralatan</a> / Peralatan Rusak</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3" id="myGroup">

            <div class="collapse multi-collapse" id="laporanRusak" data-parent="#myGroup">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Laporan Rusak/Tidak Kembali
                        </div>
                    <div class="card-body">

                            <form action="{{ route('rusak.laporan') }}" method="GET" >
                                {{ csrf_field() }}
                                <input type="hidden" id="id_menu">
                                <div class="form-group col-md-6">
                                    <label for="">Tanggal Awal</label>
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="" id="tanggal_awal" class="form-control" name="tanggal_penyewaan" value="{{ date('d-m-Y') }}">

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="">Tanggal Akhir</label>
                                    <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                     <label for="">Nama Peralatan</label>
                                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="nama_peralatan">
                                        <option value="all" selected>Semua</option>
                                        @foreach ($peralatan as $alat)
                                            <option value="{{ $alat->id_peralatan }}">{{ $alat->nama_peralatan }}</option>

                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <button type="submit"  class="btn btn-primary" style="float:right;"><i class="fa fa-print"></i> Print </button></td>
                                </div>
                            </form>
                    </div>

                    </div>

                </div>

            </div>

              <div class="col-lg-12">
                   @card
                   @slot('header')
                        Data <strong>Peralatan Rusak/Tidak Kembali</strong>
                        <a class="btn btn-primary" style="float:right;" data-toggle="collapse" href="#laporanRusak" role="button" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-eye"></i> Lihat</a>
                    @endslot
                    <div class="table-responsive">
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Kode Penyewaan</th>
                        <th>Nama Peralatan</th>
                        <th>Satuan</th>
                        <th>jumlah</th>
                        {{-- <th>Aksi</th> --}}
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>Tanggal</th>
                        <th>Kode Pengembalian</th>
                        <th>Nama Peralatan</th>
                        <th>Satuan</th>
                        <th>jumlah</th>
                        {{-- <th>Aksi</th> --}}
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($peralatanRusak as $row)
                      <tr>
                       <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ url('admin/penyewaan/detail', $row->pengembalian->id_penyewaan) }}" class="" data-toggle="tooltip" data-placement="top" title="Detail "> {{ $row->pengembalian->id_penyewaan }}</a>
                        </td>
                        <td>{{ $row->peralatan->nama_peralatan }}</td>
                        <td>{{ $row->peralatan->satuan->nama_satuan }}</td>
                        <td>{{ $row->jumlah_rusak }}</td>
                        {{-- <td>
                        <a href="#" class="btn btn-warning edit"><i class="fa fa-pencil"></i> </a>
                        <a href="#" class="btn btn-danger delete" style="display:inline;"><i class="fa fa-trash"></i></a>
                        </form>
                        </td> --}}
                        </tr>
                        @endforeach
                         </tbody>

                  </table>
                  </div>

                      @slot('footer')

                        @endslot
                      @endcard


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')
    <script type="text/javascript">

    $(document).ready(function () {
        var table = $('#tabel-data').DataTable();

            // DatePicker
        $( "#tanggal_awal" ).datepicker({
                dateFormat: "dd-mm-yy"
                });


        $( "#tanggal_akhir" ).datepicker({
        dateFormat: "dd-mm-yy"
        });

    });
</script>

    @endpush

@extends('peralatan.form')


