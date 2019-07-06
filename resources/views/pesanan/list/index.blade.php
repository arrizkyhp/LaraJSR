@extends('layouts.back.master')

@section('title')
<title>List Pesanan | Jembar Sari Rasa</title>
@endsection

@push('script')
 <script type="text/javascript">
      // $(document).on('click','.btnDetail',function (e) {
      //     var id = $(this).data('id');
      //     $.ajax({
      //         type: "get",
      //         url: "{{url('admin/getDetailPesanan')}}/"+id,
      //         success: function (response) {
      //           $('#id_pesanan').html(response.id_pesanan);
      //           // alert(response.id_pesanan);

      //            $.each(response, function(i, item) {
      //           $('<tr id="isi">').append(
      //               $('<td>').text(item.id_menu),
      //               $('<td>').text(item.quantity)

      //           ).appendTo('#tabel-modal');
      //           // $('#records_table').append($tr);
      //           //console.log($tr.wrap('<p>').html());
      //       });

      //         }
      //     });
      //     $('#modalDesc').modal('show');
      // });
</script>
@endpush

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>List Pesanan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="dashboard">Dashboard </a>/ <a href="pesanan">Pesanan</a> / List Pesanan </li>
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
                   @card
                   @slot('header')
                        Data <strong>Menu</strong>
                        <a href="pesanan" class="btn btn-primary" style="float:right;"><i class="fa fa-plus-square"></i> Tambah Pesanan </a>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Pembayaran</th>
                        <th style='display:none;'>status</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Pesanan</th>
                         <th>Pembayaran</th>
                        <th style='display:none;'>Status</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($pesanan as $row)
                        <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->id_pesanan }}</td>
                        <td>{{ $row->pelanggan->nama_pelanggan }}</td>
                        <td>{{ date('d-m-Y', strtotime($row->tanggal_pesanan )) }}</td>
                        {{-- <td>
                            @if ($row->detail_pesanan)
                            @foreach ($row->detail_pesanan as $d_pesanan)
                            <a href="#" data-id="{{$d_pesanan->id_detail_pesanan}}" class="btn btn-success btn-sm btn-descSer">{{ $d_pesanan->id_menu }} : {{$d_pesanan->quantity}}</a>
                            @endforeach
                            @endif
                        </td> --}}
                        <td>
                            @if($row->status_bayar == 0)
                            <span class="badge badge-success" style="margin-right:5px;"> Lunas </span>
                            @elseif($row->status_bayar == 1)
                            <span class="badge badge-danger" style="margin-right:5px;"> Belum Lunas </span>
                            @endif
                        </td>
                        <td style='display:none;'>{{ $row->status_bayar }}</td>
                         <td>
                            @if($row->status_pesanan == 0)
                            <a href="#" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Pesanan Selesai"><i class="fa fa-check"></i> </a>
                            @elseif($row->status_pesanan == 1)
                             <a href="#" id="konfirm" class="btn btn-danger btnDetail" data-toggle="tooltip" data-placement="top" title="Pesanan Belum Selesai"><i class="fa fa-times"></i> </a>
                            @endif
                        </td>
                        {{-- <td> <label for="" class="badge badge-info">{{ $row->jenis_pesanan->nama_jenis_pesanan }}</label></td>
                        <td>{{ $row->deskripsi }}</td>
                        <td>{{ $row->harga }}</td> --}}
                        <td>

                          <a href="{{ url('admin/pesanan/detail', $row->id_pesanan) }}" class="btn btn-info btnDetail" data-toggle="tooltip" data-placement="top" title="Detail Pesanan"><i class="fa fa-info"></i> </a>
                            @if ($row->status_pesanan == 0)

                            @else
                            <a href="{{ url('admin/pesanan/edit', $row->id_pesanan) }}" class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="Ubah Pesanan"><i class="fa fa-pencil"></i> </a>
                            @endif

                        <a href="#" id="delete" class="btn btn-danger delete" style="display:inline;"  data-toggle="tooltip" data-placement="top" title="Hapus Pesanan"><i class="fa fa-trash"></i></a>
                        </form>
                        </td>
                      </tr>
                        @endforeach
                         </tbody>

                  </table>

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
       $('body').toggleClass('open');
        $('[data-toggle="tooltip"]').tooltip();
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



        $('.selesai').on('click',function()
        {
            var tr = $('#tabel-data').closest('tr');
              if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();


               if (data[5] == 1) {
                 alertBayar();
                  return false;
               }

        });

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

        function alertBayar() {
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Pesanan Ini Belum Lunas!',

            });
          }


    });
</script>

    @endpush

@extends('pesanan.list.form')


