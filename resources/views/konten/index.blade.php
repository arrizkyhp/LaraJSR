@extends('layouts.back.master')

@section('title')
<title>Jenis Pesanan | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-sm-center">
                            <strong class="card-title">Menu</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <div class="h1 text-muted text-center mb-4">
                                    <i class="fa fa-book text-dark"></i>
                                </div>
                                <form action="{{ route('konten.menu') }}">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Kelola" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-sm-center">
                            <strong class="card-title">List Makanan</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <div class="h1 text-muted text-center mb-4">
                                    <i class="fa fa-cutlery text-dark"></i>
                                </div>
                                <form action="{{ asset('admin/list_makanan')}}">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Kelola" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-sm-center">
                            <strong class="card-title">Sewa Peralatan</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <div class="h1 text-muted text-center mb-4">
                                    <i class="fa fa-briefcase text-dark"></i>
                                </div>
                                <form action="{{ asset('admin/peralatan')}}">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Kelola" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



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


