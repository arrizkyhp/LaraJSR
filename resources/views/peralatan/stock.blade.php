@extends('layouts.back.master')

@section('title')
<title>Stock {{ $peralatan->nama_peralatan }} | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Stock {{ $peralatan->nama_peralatan }}  </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="dashboard">Dashboard </a>/ <a href="/admin/peralatan">Peralatan</a> / Stock</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>



        <div class="content mt-3">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                     <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                    Penyesuaian
                  </div>
              <div class="card-body">

                     <form action="{{ route('stock.update',$stockBaru->id_stock) }}" method="GET" >
                        {{ csrf_field() }}
                        <input type="hidden" id="id_menu">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" id="stock" class="form-control"  name="stock" value="{{ $stockBaru->stock }}" >
                            <input type="hidden" id="stock" class="form-control"  name="id_peralatan" value="{{ $peralatan->id_peralatan }}" >
                            </div>

                        </div>

                        <div class="form-group col-md-4">
                            <div class="form-group">
                            <label for="">Tersedia</label>
                            <input type="number" id="stock" class="form-control"  name="tersedia" value="{{ $stockBaru->tersedia }}" >
                            </div>

                        </div>
                            <div class="form-group col-md-4">
                            <div class="form-group">
                            <label for="">Keluar</label>
                            <input type="number" id="stock" class="form-control"  name="keluar" value="{{ $stockBaru->keluar }}" >
                            </div>

                        </div>
                         <div class="form-group col-md-8" >
                            <label for="">Keterangan</label>
                            <textarea name="keterangan"  class="form-control"></textarea>
                        </div>


                        <div class="col-md-4">
                               <button type="submit"  class="btn btn-primary" style="float:right;"></i> Update </button></td>
                        </div>
                    </form>
                 </div>


                 </div>
              </div>
            </div>




              <div class="col-lg-12">
                   @card
                   @slot('header')
                    History
                    <div style="float:right;" >
                       <div class="btn-group" >
                        <a href="{{ route('stock.print',$stockBaru->id_stock) }}" class="btn btn-primary" style="float:right;" ><i class="fa fa-print"></i> Print </a>
                      </div>
                      <div class="btn-group" >
                        <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Penyesuaian</a>
                      </div>
                    </div>
                    @endslot

                   <div class="table-responsive">
                      <table id="tabel-data" class="table table-striped table-bordered table-hover  table-fit" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Stock Awal</th>
                        <th>Tersedia</th>
                        <th>Keluar</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>

                      <tbody>
                         @php $no = 1; @endphp
                        @foreach ($stock as $row)
                      <tr>
                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $row->stock }}</td>
                        <td>{{ $row->tersedia }}</td>
                        <td>{{ $row->keluar }}</td>
                        <td>{{ $row->keterangan }}</td>

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

        var table = $('#tabel-data').DataTable();

         $('#jenis_pesanan').on('change', function(){
              setCode();
            });

              // get Perlengkapan ketika select
        $('#id_peralatan').on('change', function () {
        var id = $(this).val();

        $.ajax({
            type: "get",
            url: "{{url('/admin/get_peralatan')}}/"+id,
            success: function (response) {

                $('#id_peralatan').val(response.id_peralatan);
                $('#nama_peralatan').val(response.nama_peralatan);
                $('#stock').attr('readonly', false);
                $('#button_tambah').attr('disabled', false);
                // $('#stock').attr("placeholder", "tersedia "+ response.stock);
                $('#stock_ghost').val(response.stocks.tersedia);
                $('#stock').val(response.stocks.tersedia);
                $('#stock_gudang').html(response.stocks.tersedia);
                $('#harga').val(response.harga_sewa);


            }
        });
        });




    });
</script>

    @endpush

@extends('pesanan.list.form')


