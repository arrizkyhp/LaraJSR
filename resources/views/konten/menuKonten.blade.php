@extends('layouts.back.master')

@section('title')
<title>Jenis Pesanan | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Konten</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="#">Dashboard</a> / Konten</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">

              <div class="col-lg-12">
                   @card
                   @slot('header')
                        Data <strong>Konten</strong>
                        <button class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square"></i> Tambah </button>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Foto</th>
                        <th>Nama Konten</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Foto</th>
                        <th>Nama Konten</th>
                        <th>Jenis</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($konten as $row)
                      <tr>
                      <td>{{ $no++ }}</td>
                      <th style="display:none;">{{ $row->id_konten }}</th>
                      <td><img src="{{ asset('uploads/'.@$row->foto) }}" width="80px" class="img" alt=""></td>
                      <td>{{ $row->nama_konten }}</td>
                      <td>{{ $row->jenis->nama_jenis_pesanan }}</td>
                      <td>{{ $row->deskripsi }}</td>
                        <td>
                        <a href="{{ url("admin/konten/menu/edit/$row->id_konten")}}" class="btn btn-warning edit"><i class="fa fa-pencil"></i> </a>
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
    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')
    <script type="text/javascript">

    $(document).ready(function () {
        var table = $('#tabel-data').DataTable();

        // Start Edit Record
        table.on('click', '#edit', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#nama_jenis_pesanan').val(data[3]);
            $('#deskripsi').val(data[4]);


            $('#editForm').attr('action','/jenis_pesanan/'+data[1]);
            $('#editModal').modal('show');

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


            $('#deleteForm').attr('action','/jenis_pesanan/'+data[1]);
            $('#deleteModal').modal('show');

        });
        // End Delete Record

    });
</script>

    @endpush

@extends('konten.form')


