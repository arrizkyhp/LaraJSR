@extends('layouts.back.master')

@section('title')
<title>Menu | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Menu</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="#">Dashboard</a> / Menu</li>
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
                        <a href="#" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-plus-square"></i> Tambah </a>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                         <th>#</th>
                         <th>Kode</th>
                        <th>Nama Menu</th>
                        <th>Jenis Pesanan</th>
                        <th>List Makanan/Minuman</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Menu</th>
                        <th>Jenis Pesanan</th>
                        <th>List Makanan/Minuman</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($menu as $row)
                      <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $row->id_menu }}</td>
                      <td>{{ $row->nama_menu }}</td>
                        <td> <label for="" class="badge badge-success">{{ $row->jenis_pesanan->nama_jenis_pesanan }}</label></td>
                        <td>
                       @foreach ($row->detail_menu as $detail)
                         <label for="" class="badge badge-info">{{ $detail->list_makanan->nama_makanan }}</label>
                       @endforeach
                       </td>
                        <td>{{ $row->harga }}</td>
                        <td>
                        <a href="{{ route('menu.edit', $row->id_menu) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> </a>
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

    @push('script')
     <script src="{{ asset('vendors/chosen/chosen.jquery.min.js')  }}"></script>
    <script type="text/javascript">

    $(document).ready(function () {
        var table = $('#tabel-data').DataTable();

         $('#jenis_pesanan').on('change', function(){
              setCode();
            });

          jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
            });


        // Start Delete Record
        table.on('click', '#delete', function() {

            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);


            $('#deleteForm').attr('action','/admin/menu/'+data[1]);
            $('#deleteModal').modal('show');

        });
        // End Delete Record

        function setCode() {
            var id_kategori = $('#jenis_pesanan :selected').val();
            // var id = document.getElementById('id_kategori').value;
            // console.log(id);
            $.ajax({
                type: 'get',
                url: '{{url('admin/menu/getInitialCodeById')}}'+'/'+id_kategori,
                success : function (response) {
                    $("#kode_menu").val(response);
                }
            });

        }

    });
</script>

    @endpush

@extends('menu.form')


