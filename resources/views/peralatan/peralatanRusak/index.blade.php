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

        <div class="content mt-3">

              <div class="col-lg-12">
                   @card
                   @slot('header')
                        Data <strong>Peralatan Rusak/Tidak Kembali</strong>

                    @endslot
                    <div class="table-responsive">
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode Pengembalian</th>
                        <th>Nama Peralatan</th>
                        <th>Satuan</th>
                        <th>jumlah</th>
                        {{-- <th>Aksi</th> --}}
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
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
                       <td>{{ $no++ }}</td>
                        <td>{{ $row->id_pengembalian }}</td>
                        <td>{{ $row->peralatan->nama_peralatan }}</td>
                        <td>{{ $row->peralatan->satuan }}</td>
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

        // Start Edit Record
       table.on('click', '.edit', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#nama_peralatan').val(data[2]);
            $('#satuan').val(data[6]);
            $('#stock').val(data[3]);
            $('#keluar').val(data[4]);
            $('#tersedia').val(data[5]);
            $('#harga_sewa').val(data[9]);
            $('#harga_ganti').val(data[10]);

            $('#editForm').attr('action','/admin/peralatan/'+data[1]);
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


            $('#deleteForm').attr('action','/admin/peralatan/'+data[1]);
            $('#deleteModal').modal('show');

        });
        // End Delete Record

    });
</script>

    @endpush

@extends('peralatan.form')


