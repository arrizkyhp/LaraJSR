@extends('layouts.back.master')

@section('title')
<title>Users | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="#">Dashboard</a> / Users</li>
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
                        Data <strong>Users</strong>
                        <a href="{{ route('users.create') }}" class="btn btn-primary" style="float:right;" ><i class="fa fa-plus-square"></i> Tambah </a>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>

                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>

                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($users as $row)
                      <tr>
                      <td>{{ $no++ }}</td>
                      <th style="display:none;">{{ $row->id }}</th>
                      <td>{{ $row->name  }}</td>
                        <td>{{ $row->username  }}</td>
                        <td>
                             @if ($row->role == 0)
                            <label class="badge badge-info">Admin</label>
                            @else
                            <label for="" class="badge badge-info">Manajer Operasional</label>
                            @endif
                        </td>
                        <td>
                        <a href="{{ route('users.edit', $row->id_users) }}" class="btn btn-warning "><i class="fa fa-pencil"></i> </a>
                        <a href="#" id="delete" class="btn btn-danger delete" style="display:inline;"><i class="fa fa-trash"></i></a>
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

    @section('script')
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

            $('#nama_pelanggan').val(data[2]);
            $('#alamat').val(data[3]);
            $('#no_telepon').val(data[4]);

            $('#editForm').attr('action','/pelanggan/'+data[1]);
            $('#editModal').modal('show');

        });
        // End Edit Record

        // Start Delete Record
        table.on('click', '#delete', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);


            $('#deleteForm').attr('action','/users/'+data[1]);
            $('#deleteModal').modal('show');

        });
        // End Delete Record

    });
</script>

    @endsection

@extends('users.form')


