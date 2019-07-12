@extends('layouts.back.master')

@section('title')
<title>Laporan | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Laporan </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="dashboard">Dashboard </a> / List Laporan </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="content mt-3" id="myGroup">

    {{-- START Collapse --}}
            <div class="collapse multi-collapse" id="laporanPesanan" data-parent="#myGroup">
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      Laporan Pesanan
                  </div>
              <div class="card-body">

                     <form action="{{ route('pesanan.laporanPrint') }}" method="GET" >
                        {{ csrf_field() }}
                        <input type="hidden" id="id_menu">
                        <div class="form-group col-md-6">
                            <label for="">Tanggal Awal</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="" id="tanggal_awalPesanan" class="form-control" name="tanggal_penyewaan" value="{{ date('d-m-Y') }}">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                         <label for="">Tanggal Akhir</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="" id="tanggal_akhirPesanan" class="form-control" name="tanggal_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                            </div>
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

            <div class="collapse multi-collapse" id="laporanPenyewaan" data-parent="#myGroup">
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      Laporan Penyewaan
                  </div>
              <div class="card-body">

                     <form action="{{ route('sewa.laporanPrint') }}" method="GET" >
                        {{ csrf_field() }}
                        <input type="hidden" id="id_menu">
                        <div class="form-group col-md-6">
                            <label for="">Tanggal Awal</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="" id="tanggal_awalPenyewaan" class="form-control" name="tanggal_penyewaan" value="{{ date('d-m-Y') }}">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                         <label for="">Tanggal Akhir</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="" id="tanggal_akhirPenyewaan" class="form-control" name="tanggal_akhir" value="{{ date('d-m-Y') }}" autocomplete="off">
                            </div>
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

        {{-- END OF COLLAPSE --}}

              <div class="col-lg-12">
                   @card
                   @slot('header')

                   @endslot
                   <div class="table-responsive">
                      <table id="tabel-data" class="table table-striped table-bordered table-hover  table-fit"" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                      <tbody>
                        <tr>
                            <th>1</th>
                            <td>Laporan Pesanan</td>
                            <td>
                            <a class="btn btn-primary" data-toggle="collapse" href="#laporanPesanan" role="button" aria-expanded="false" aria-controls="collapseOne"><i class="fa fa-eye"></i> Lihat</a>
                            </td>
                        </tr>
                         <tr>
                            <th>2</th>
                            <td>Laporan Penyewaan</td>
                            <td>
                            <a class="btn btn-primary" data-toggle="collapse" href="#laporanPenyewaan" role="button" aria-expanded="false" aria-controls="collapseTwo"><i class="fa fa-eye"></i> Lihat</a>
                            </td>
                        </tr>

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

      // DatePicker
        $( "#tanggal_awalPesanan" ).datepicker({
                dateFormat: "dd-mm-yy"
                });


        $( "#tanggal_akhirPesanan" ).datepicker({
        dateFormat: "dd-mm-yy"
        });

        $( "#tanggal_awalPenyewaan" ).datepicker({
        dateFormat: "dd-mm-yy"
        });

        $( "#tanggal_akhirPenyewaan" ).datepicker({
        dateFormat: "dd-mm-yy"
        });


        var table = $('#tabel-data').DataTable();

         $('#jenis_pesanan').on('change', function(){
              setCode();
            });


        // Start Delete Record
        table.on('click', '#delete', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);


            $('#deleteForm').attr('action','/admin/pesanan/'+data[1]);
            $('#deleteModal').modal('show');

        });
        // End Delete Record

        // Start Konfirm Record
        table.on('click', '#konfirm', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);


            $('#konfirmForm').attr('action','/admin/selesai_pesanan/'+data[1]);
            $('#konfirmModal').modal('show');

        });
        // End Delete Record

        function setCode() {
            var id_kategori = $('#jenis_pesanan :selected').val();
            // var id = document.getElementById('id_kategori').value;
            // console.log(id);
            $.ajax({
                type: 'get',
                url: '{{url('menu/getInitialCodeById')}}'+'/'+id_kategori,
                success : function (response) {
                    $("#kode_menu").val(response);
                }
            });

        }

    });
</script>

    @endpush

@extends('pesanan.list.form')


