@extends('layouts.back.master')

@section('title')
<title>Stock | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Peralatan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="#">Dashboard</a> / Peralatan</li>
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
                        Data <strong>Peralatan</strong>
                        <div style="float:right;">
                           @if (auth()->user()->role == 1 )
                          <div class="btn-group" >
                            <a href="{{ url('admin/peralatan_rusak') }}" class="btn btn-danger" >Peralatan Rusak/Tidak Kembali </a>
                          </div>
                           @endif
                          <div class="btn-group" >
                            <button class="btn btn-info "  data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-plus-square"></i> Tambah Satuan  </button>
                          </div>
                          <div class="btn-group" >
                            <button class="btn btn-primary "  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-square"></i> Tambah  </button>
                          </div>
                        </div>
                    @endslot
                    <div class="table-responsive">
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Peralatan</th>
                         @if (auth()->user()->role == 1 )
                        <th>Stock</th>
                        <th>Tersedia</th>
                        <th>Keluar</th>
                        @endif
                        <th>Satuan</th>
                        <th>Harga Sewa</th>
                        <th>Harga Ganti</th>
                        <th style="display:none;">hs</th>
                        <th style="display:none;">hs</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Peralatan</th>
                        @if (auth()->user()->role == 1 )
                        <th>Stock</th>
                        <th>Tersedia</th>
                        <th>Keluar</th>
                        @endif
                        <th>Satuan</th>
                        <th>Harga Sewa</th>
                        <th>Harga Ganti</th>
                        <th style="display:none;">hs</th>
                        <th style="display:none;">hs</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($peralatan as $row)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td style="display:none;">{{ $row->id_peralatan }}</td>
                        <td>{{ $row->nama_peralatan }}</td>
                         @if (auth()->user()->role == 1 )
                        <td>{{ $row->stocks->stock }}</td>
                        <td>{{ $row->stocks->tersedia }}</td>
                        <td> {{ $row->stocks->keluar }}</td>
                        @endif
                        <td>{{ $row->satuan->nama_satuan }}</td>
                        <td>Rp.{{ number_format($row->harga_sewa,0,',', '.') }}</td>
                        <td>Rp.{{ number_format($row->harga_ganti,0,',', '.') }}</td>
                        <td style="display:none;">{{ $row->harga_sewa }}</td>
                        <td style="display:none;">{{ $row->harga_ganti }}</td>
                        <td>

                        @if (auth()->user()->role == 0 )

                        <a href="{{ route('peralatan.edit',$row->id_peralatan) }}" class="btn btn-warning "><i class="fa fa-pencil"></i> </a>
                        <a href="#" class="btn btn-danger delete" style="display:inline;"><i class="fa fa-trash"></i></a>
                        @else
                          <a href="{{ route('stock.peralatan',$row->id_peralatan) }}" class="btn btn-info "><i class="fa fa-suitcase"></i> </a>
                        <a href="{{ route('peralatan.edit',$row->id_peralatan) }}" class="btn btn-warning "><i class="fa fa-pencil"></i> </a>
                        <a href="#" class="btn btn-danger delete" style="display:inline;"><i class="fa fa-trash"></i></a>
                        @endif
                        </form>
                        </td>
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


