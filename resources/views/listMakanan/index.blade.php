@extends('layouts.back.master')

@section('title')
<title>List Makanan | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>List Makanan </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="#">Dashboard</a> / List Makanan </li>
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

              <div class="col-lg-6">
                   @card
                   @slot('header')
                        Data <strong>Makanan</strong>
                        <button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square"></i> Tambah </button>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Makanan/Minuman</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Makanan/Minuman</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($listMakanan as $row)
                      <tr>
                      <td>{{ $no++ }}</td>
                      <th style="display:none;">{{ $row->id_list_makanan }}</th>
                       <td>{{ $row->nama_makanan }}</td>
                      <td>{{ $row->jenis_makanan->nama_jenis_makanan }}</td>


                        <td>
                        <a href="#" class="btn btn-warning edit" data-id="{{ $row->id_list_makanan }}"><i class="fa fa-pencil"></i> </a>
                        <a href="#" class="btn btn-danger delete" style="display:inline;"><i class="fa fa-trash"></i></a>
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
         <div class="col-lg-6">
                   @card
                   @slot('header')
                        Data <strong>Jenis Makanan</strong>
                        <button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#jenisMakananModal"><i class="fa fa-plus-square"></i> Tambah </button>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Jenis Makanan/Minuman</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                         <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Jenis Makanan/Minuman</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($jenisMakanan as $row)
                      <i>
                      <td>{{ $no++ }}</td>
                      <th style="display:none;">{{ $row->id_jenis_makanan }}</th>
                      <td>{{ $row->nama_jenis_makanan }}</td>
                        <td>
                         <a href="#" class="btn btn-warning bruh" data-id="{{ $row->id_list_makanan }}"><i class="fa fa-pencil"></i> </a>
                        <a href="" class="btn btn-danger delete" style="display:inline;"><i class="fa fa-trash"></i></a>
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
        var table = $('#tabel-data').DataTable();

        // Start Edit Record
        $(document).on('click','.edit',function (e) {

            var id = $(this).data('id');
               $.ajax({
              type: "get",
              url: "{{url('admin/getListMakanan')}}/"+id,
              success: function (response) {
                $('#nama_makanan').val(response.nama_makanan);
                $('#test').html(response.jenis_makanan.nama_jenis_makanan);


              }
          });

            $('#editForm').attr('action','/admin/listMakanan/'+id);
            $('#editModal').modal('show');

        });
        // End Edit Record

         // Start Edit Record
       $(document).on('click','.bruh',function (e) {


            $('#editModal2').modal('show');

        });
        // End Edit Record

        // Start Delete Record
        table.on('click', '.delete', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);


            $('#deleteForm').attr('action','/pelanggan/'+data[1]);
            $('#deleteModal').modal('show');

        });
        // End Delete Record

    });
</script>

    @endpush

@extends('listMakanan.form')


