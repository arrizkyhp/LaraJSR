@extends('layouts.back.master')

@section('title')
<title>Penyewaan Peralatan | Jembar Sari Rasa</title>
@endsection

@push('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
@endpush


{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Penyewaan Peralatan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="{{ asset('admin/dashboard') }}">Dashboard </a>/ Penyewaan<a href="{{ asset('admin/list_penyewaan') }}"> / List Penyewaan</a>  </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3">
             <form role="form" action="{{ route('penyewaan.store') }}" id="form-submit" method="post" enctype="multipart/form-data">
              @csrf

             <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      Info Sewa
                  </div>
              <div class="card-body">

                  <!-- Cart submit form -->

                    <!-- SmartCart element -->
                <div class="form-row">
                        <input type="hidden" id="id_menu">
                        <div class="form-group col-md-6">
                            <label for="">Tanggal Penyewaan</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="date" id="tanggal_penyewaan" class="form-control" name="tanggal_penyewaan" value="{{ date('Y-m-d') }}">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                         <label for="">Sampai Tanggal</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir">
                            </div>
                    </div>
                </div>

                 </div>
              </div>

            </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Detail Sewa
            </div>
                <div class="card-body">

                  <!-- Cart submit form -->

                    <!-- SmartCart element -->
                    <div class="form-row">
                        <input type="hidden" id="id_menu">
                        <div class="form-group col-md-6">
                            <label for="nama_pelanggan">Perlengkapan</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <select id="id_peralatan" name="id_peralatan" data-placeholder="Nama Peralatan.." class="form-control select-peralatan" tabindex="1" id="peralatan_select">
                                        <option value=""></option>
                                        @foreach ($peralatan as $peralatans)
                                        <option value="{{ $peralatans->id_peralatan }}">{{ $peralatans->nama_peralatan }} - {{ $peralatans->stock }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                             <label for="nama_pelanggan">Nama Pelanggan</label><a href="http://"  style="float:right;" data-toggle="modal" data-target="#exampleModal">Tambah Pelanggan Baru</a>
                        {{-- <input type="nama_pelanggan" name="nama_pelanggan" id="nama_pelanggan" class="form-control" id="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" > --}}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <select name="id_pelanggan" data-placeholder="Masukan Nama Pelanggan.." class="form-control js-example-basic-multiple" tabindex="1" id="pelanggan_select">
                                <option value=""></option>
                                @foreach ($pelanggan as $pelanggans)
                                <option value="{{ $pelanggans->id_pelanggan }}">{{ $pelanggans->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="form-group col-md-2">
                            <span style="float:right"><b>Stock</b><h3><span class="badge badge-info"><div id="stock_gudang"></div></span></h3></span>
                        </div>
                        <div class="form-group col-md-12">
                            <hr>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nama_pelanggan">Nama Peralatan</label>
                                <input type="text" id="nama_peralatan" name="nama_peralatan" class="form-control" placeholder="" readonly>
                                <input type="hidden" id="id_peralatan" class="form-control" placeholder="" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nama_pelanggan">Jumlah Sewa</label>
                                <input type="hidden" id="stock_ghost">
                                <input type="number" id="stock" class="form-control" min="0"  readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="harga">Harga</label>
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="" readonly>
                                <input type="hidden" id="subtotal"  class="form-control" readonly>
                        </div>
                         <div class="form-group col-md-2">
                              <label for="harga"></label>
                                <button type="button" id="button_tambah" class="btn btn-primary btn-add pull-right" disabled>Tambah</button>
                        </div>

                        <div class="col-md-12">
                            <table id="table-penyewaan" class="table table-bordered table-responsve table-stripped">
                                    <thead>
                                        <tr>
                                        <th>Nama Peralatan</th>
                                        <th>Jumlah Sewa</th>
                                        <th>Harga Satuan</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                              <textarea cols="25" rows="3" placeholder="Keterangan (jika ada)" name="keterangan"></textarea>
                        </div>

                        <div class="col-md-6">
                             <div class="form-group" style="text-align:right">
                                <span >Total </span><h2>Rp.<b><span id="total">0</span></b></h2>
                                 <input type='hidden' name='total_harga' class="total_harga">
                            </div>
                            <div style="float:right;">
                                <span>Bayar (Rp)</span>
                                <input type="number" id="bayar" name="bayar" class="form-control col-lg-8" min="0" style="float:right;" readonly><br><br><br>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group"  style="float:right;">
                                <button type="submit" class="btn btn-primary simpan" style="float:right;" disabled><i class="fa fa-plus-square"></i> Simpan </button>
                            </div>
                        </div>
                    </div>

                 </div>
              </div>

            </div>
             </form>
        </div>

    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')
    <script src="{{ asset('vendors/select2/select2.min.js')  }}"></script>
    <script src="{{ asset('vendors/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
    <script type="text/javascript">

    $(document).ready(function () {

        var table = $('#tabel-data').DataTable();
        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();
        // Select 2 Pelanggan
        $('.js-example-basic-multiple').select2();
        $('.select-peralatan').select2();

    // Button Simpan di Klik
      $('.simpan').click(function(){
        var tanggal_penyewaan = $("#tanggal_penyewaan").val();
        var tanggal_akhir = $("#tanggal_akhir").val();
        var nama_pelanggan = $("#pelanggan_select").val();

         if (tanggal_penyewaan == '') {
           swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Tanggal Penyewaan Belum dipilih!',

            });
           return false;
         }else if (tanggal_akhir == '') {
           swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Tanggal Akhir Belum dipilih!',

            });
          return false;
        }else if (nama_pelanggan == '') {
           swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Nama Pelanggan Belum dipilih!',

            });
          return false;
        }else {
           return true;
         }

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
                $('#stock_ghost').val(response.stock);
                $('#stock').val(response.stock);
                $('#stock_gudang').html(response.stock);
                $('#harga').val(response.harga_sewa);


            }
        });
        });

    // Button X di Klik

     $("#table-penyewaan").on('click','.btnDelete',function(){
       var rowCount = $('#table-penyewaan tr').length;

        if(rowCount == '2'){
            $('.simpan').attr('disabled', true);
            $('#bayar').attr('readonly', true);
        }

        $(this).closest('tr').remove();

        // $('#harga').text('0');
        // $('#subtotal').text('0');
        // $("input[type=text], textarea").val("");
        // $('#quantity').attr('readonly', true);


        grandtotal();


     });


    // Button Tambah di Klik
        $('#button_tambah').on('click', function () {
            var id_peralatan = $('#id_peralatan').val();
            var nama = $('#nama_peralatan').val();
            var stock = $('#stock').val();
            var stock_ghost = $('#stock_ghost').val();
            var harga = $('#harga').val();
            var subtotal = stock * harga;
            var getSubtotal = $('#subtotal').val(subtotal);
            var sama = 0;
            var row = "<tr><td style='display:none;'><input type='hidden' name='id_peralatan[]' value='"+id_peralatan+"'></td><td style='display:none;'><input type='hidden' name='stock[]' value='"+stock_ghost+"'></td><td><div class='nama-menu'>"+nama+"</div><input type='hidden' name='nama_peralatan[]' value='"+nama+"'></td><td><div class='stock'>"+stock+"</div><input type='hidden' name='jumlah_sewa[]' value='"+stock+"'></td><td>"+harga+"<input type='hidden' name='harga[]' value='"+harga+"'></td><td><div class='subtotal'>"+subtotal+"</div><input type='hidden' name='subtotal[]' value='"+subtotal+"'></td><td><button type='button' class='btn btn-danger btnDelete'>x</button></td></tr>";
            var rowCount = $('#table-penyewaan tr').length;


                if ((parseInt(stock) > parseInt(stock_ghost)) || (parseInt(stock) == 0) ) {
                    alertStock();

                }else {

                if(rowCount > 1){

                    $('#table-penyewaan tr').each(function(){
                    var nama_menu = $(this).find(".nama-menu").html();
                    if(nama == nama_menu ){
                        sama++;
                    var q = $(this).find(".stock").html();
                    var t = $(this).find(".subtotal").html();

                    $(this).find(".stock").html(parseInt(q) + parseInt(stock));
                    $(this).find(".subtotal").html(parseInt(t) + parseInt(subtotal));
                        formDisabled();
                        grandtotal();

                        return false;
                        }


                    });

                }else{

                    $('#table-penyewaan tbody').append(row);
                    formDisabled();
                    grandtotal();
                }

                if(sama == 0 && rowCount > 1){

                    $('#table-penyewaan tbody').append(row);
                    formDisabled();
                    grandtotal();

                }

            }


        });



        // Function

         function alertStock() {
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Stock tidak Cukup!',

            });
          }

          function formDisabled() {
            var stock_ghost = $('#stock_ghost').val('');
            var stock = $('#stock').val('');
            var jumlahStock = stock_ghost - stock;

            $('#stock').attr('readonly', true);
            $('#button_tambah').attr('disabled', true);
            $('.simpan').attr('disabled', false);
            $('#bayar').attr('readonly', false);
            $('#nama_peralatan').val('');
            // $('#stock').val('');
            // $('#stock').attr("placeholder", "");
            $('#harga').val('');
            $('#id_peralatan').val('');
            $('#stock_gudang').html(jumlahStock);
          }

           function grandtotal()
          {

            var sum = 0;
            $('#table-penyewaan tbody tr').each(function(){

            sum += parseInt($('.subtotal',$(this)).text());

            // test += $('.subtotal).val(col2);
          });
            $('#total').html(sum).formatCurrency();
            var raw = $('#total').html().replace(/[^\d,-]/g, '');
            var raw = raw.replace(",", '');


             $('.total_harga').val(raw);
          }

    });
</script>

    @endpush

@extends('peralatan.form')


