@extends('layouts.back.master')

@section('title')
<title>Pesanan | Jembar Sari Rasa</title>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('vendors/smartcart/css/smart_cart.min.css') }}">
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<style>
  .sc-added-item:before{
    display:none;
  }
</style>
@endpush

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Pesanan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="Dashboard">Dashboard </a>/ Pesanan<a href="list_pesanan"> / List Pesanan</a></li>
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
             <form role="form" action="{{ route('pesanan.store') }}" id="form-submit" method="post" enctype="multipart/form-data">
              @csrf


            {{--------------- Detail Pesanan -----------------}}

             <div class="col-lg-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-row">

                           <div class="form-group col-lg-6">
                             <label for="">Tanggal Input</label>
                             <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="" id="tanggal_penyewaan" class="form-control" name="tanggal" value="{{ date('d-m-Y') }}">

                            </div>
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="alamat">Tanggal Pesanan</label>
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                  <input type="" name="tanggal_pesanan" id="datepicker" class="form-control datepicker" autocomplete="off" style="width: 60%">
                            </div>
                          </div>



                          <div class="form-group col-lg-7">
                            <label for="nama_pelanggan">Nama Pelanggan</label><a href="http://" style="float:right;" data-toggle="modal" data-target="#exampleModal">Tambah Pelanggan Baru</a>
                            {{-- <input type="nama_pelanggan" name="nama_pelanggan" id="nama_pelanggan" class="form-control" id="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" > --}}
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <select name="id_pelanggan" data-placeholder="Masukan Nama Pelanggan.." class="form-control js-example-basic-multiple" tabindex="1" id="pelanggan_select" style="width: 80%">
                                  <option value=""></option>
                                  @foreach ($pelanggan as $pelanggans)
                                    <option value="{{ $pelanggans->id_pelanggan }}">{{ $pelanggans->nama_pelanggan }}</option>
                                  @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="form-group col-lg-5">
                            <button type="button" class="btn btn-primary" style="float:right;" role="button" data-toggle="modal" data-target="#modalMenu">Pilih Menu</button>
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="alamat">Alamat</label>
                              <input type="alamat" id="alamat" class="form-control" id="alamat"  readonly>
                          </div>

                          <div class="form-group col-lg-6">
                            <label for="no_telepon">No Telepon</label>
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                  <input type="no_telepon" id="no_telepon" class="form-control" id="no_telepon" type="number" id="number" min="0" type="number" readonly>
                              </div>
                          </div>



                          <div class="table-responsive">
                            <table id="tabel-pesanan" class="table table-striped table-bordered table-hover tabel-pesanan">
                              <thead>
                                <tr>
                                <th>Nama Menu</th>
                                <th>Jenis Pesanan</th>
                                <th>Quantity</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                                </tr>
                              </thead >
                              <tbody>
                              </tbody>
                            </table>
                          </div>

                          {{-- Rupiah --}}
                          <div class="col-lg-8">
                            <textarea cols="25" rows="3" placeholder="Keterangan (jika ada)" name="keterangan"></textarea>
                          </div>

                          <div class="form-group col-lg-4" >
                            <div style="float:right;">
                              <span>Total Harga </span><h2>Rp.<b><span class="grandtotal" class="text-right">0</span></b></h2>
                                <input type='hidden' name='total_harga' class="total_harga">
                              <span>Uang Muka </span><h2>Rp.<b><span class="downPaymentOut" class="text-right">0</span></b></h2>
                                <input type='hidden' name='downPayment' class="downPayment">
                            </div>
                          </div>

                          <div class="form-group col-lg-12" >
                            <div style="float:right;">
                              <span>Bayar (Rp)</span>
                                <input type="number" id="bayar" name="bayar" class="form-control col-lg-8" min="0" style="float:right;" readonly>
                            </div>
                          </div>

                          <div class="form-group col-lg-12">
                            {{-- <button type="button" class="btn btn-primary hasil-pesanan" style="float:right;">Hasil</button> --}}
                            <button type="submit" class="btn btn-primary btn-submit" id="btn-submit" style="float:right;" disabled>Simpan</button>

                          </div>

                        </div>
                      </div>
                    </div>


                   <div class="collapse multi-collapse" id="multiCollapseExample1">
                    @card
                   @slot('header')
                      Data <strong>Menu</strong>

                   @endslot



                      @slot('footer')

                        @endslot
                      @endcard
            </div>
          </div>


              {{--------------- Cart-----------------}}

            <div class="col-lg-4">
              <div id="cart">
              <div class="card">

              <div class="card-body">

                  <!-- Cart submit form -->

                    <!-- SmartCart element -->
                    <input type="hidden" id="id_menu">
                    <input type="hidden" id="status_peralatan">
                    <div class="form-group ">
											<label for="">Nama Menu</label>
												<input type="text" id="nama_menu" class="form-control " readonly>
                    </div>
                    <div class="form-group">
											<label for="">Jenis Pesanan</label>
												<input type="text" id="jenis" class="form-control" readonly>
                    </div>
                     <div class="form-group">
											<label for="">Qty</label>
                        <input type="number" id="quantity" class="form-control col-lg-4" min="0" style="float:right;" readonly><br>

                    </div>
                       <div class="form-group" style="text-align:right">
											<span >Harga </span><h2>Rp.<b><span id="harga">{{ number_format('0') }}</span></b></h2>
                    </div>

                     <div class="form-group"  style="text-align:right;">
												<span >Subtotal </span><h2>Rp.<b><span id="subtotal">0</span></b></h2>
										</div>

                    <div class="form-group"  style="text-align:right;">
											<button type="button" class="btn btn-primary tambah-transaksi" style="float:right;" disabled><i class="fa fa-plus-square"></i> Tambah Transaksi </button>
										</div>

            </div>
              </div>
                </div>
            </div>

            {{-- Card Peralatan --}}

            <div class="collapse multi-collapse" id="multiCollapseExample2">
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <strong class="card-title">Peralatan</strong>
                  </div>

                  <div class="card-body">
                    <input type="hidden" id="id_menu">
                    <div class="form-group ">
											<label for="">Peralatan</label>
											  <select id="id_peralatan" name="id_peralatan" data-placeholder="Nama Peralatan.." class="form-control select-peralatan" tabindex="1" id="peralatan_select" style="width: 100%" disabled>
                            <option value=""></option>
                            @foreach ($peralatan as $peralatans)
                            <option value="{{ $peralatans->id_peralatan }}">{{ $peralatans->nama_peralatan }} - {{ $peralatans->stocks->tersedia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="nama_pelanggan">Nama Peralatan</label>
                          <input type="text" id="nama_peralatan" name="nama_peralatan" class="form-control" placeholder="" readonly>
                          <input type="hidden" id="id_peralatan" class="form-control" placeholder="" readonly>
                    </div>

                    <div class="form-group">
                    <label for="">Qty</label>
                        <input type="hidden" id="stock_ghost">
                      <input type="number" id="stock" class="form-control col-lg-4" min="0" style="float:right;" readonly ><br>
                    </div>

                    <div class="form-group"  >
                      <button type="button" id="button_tambah" class="btn btn-primary btn-add pull-right" disabled>Tambah</button><br><br>
                       <table id="table-penyewaan" class="table table-bordered table-responsve table-stripped">
                          <thead>
                              <tr>
                              <th>Nama Peralatan</th>
                              <th>Qty</th>
                              <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
										</div>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div> <!-- .content -->

        <!-- Modal -->
        <div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalMenu">Data Menu</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#exampleModal2"><i class="fa fa-plus-square"></i> Tambah Menu Baru</button>
                <hr>
                 <div class="table-responsive">
                    <table id="tabel-data" class="table table-striped table-bordered table-hover table-responsive" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th style="display:none;">id</th>
                          <th>Nama Menu</th>
                          <th>Peralatan</th>
                          <th>Jenis Pesanan</th>
                          <th>List Makanan</th>
                          <th>Harga</th>
                          <th>Aksi</th>
                          <th style="display:none;">Status Peralatan</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th style="display:none;">id</th>
                          <th>Nama Menu</th>
                          <th>Peralatan</th>
                          <th>Jenis Pesanan</th>
                          <th>List Makanan</th>
                          <th>Harga</th>
                          <th>Aksi</th>
                          <th style="display:none;">Status Peralatan</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        @php $no = 1; @endphp
                        @foreach ($menu as $row)
                          <tr class="sc-product-item">
                            <td>{{ $no++ }}</td>
                            <td style="display:none;">{{ $row->id_menu }}</td>
                            <td >{{ $row->nama_menu }}
                            </td>
                            <td>
                              @if ($row->status_peralatan == 1)
                                   <label for="" class="badge badge-success">Ya</label>
                                  @else
                                  <label for="" class="badge badge-danger">Tidak</label>
                              @endif
                            </td>
                            <td >{{ $row->jenis_pesanan->nama_jenis_pesanan }}</td>
                            <td>
                        @foreach ($row->detail_menu as $detail)
                            <label for="" class="badge badge-info">{{ $detail->list_makanan->nama_makanan }}</label>
                        @endforeach
                          </td>
                          <td>{{ $row->harga }}</td>
                          <td>
                          <a href="#cart" id="menu_data" data-dismiss="modal" class="btn btn-info btnMenu"><i class="fa fa-plus-square"></i> Tambah</a>
                          </td>
                          <td style="display:none;">{{ $row->status_peralatan }}</td>
                          </tr>
                        @endforeach
                      </tbody>

                    </table>
                  </div>
              </div>
              {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> --}}
            </div>
          </div>
        </div>


    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')

    <script src="{{ asset('vendors/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
    <script src="{{ asset('vendors/autonumeric/jquery.number.min.js')  }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js')  }}"></script>
    <script src="{{ asset('vendors/chosen/chosen.jquery.min.js')  }}"></script>
    <script src="{{ asset('vendors/chosen/chosen.jquery.min.js')  }}"></script>

    <script type="text/javascript">



    // DataTables

    $(document).ready(function () {
      // $('body').toggleClass('open');
      var table = $('#tabel-data').DataTable();
      // $('#harga').number( true, 4 );

        // Modal dalam Modal
         $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });





      $('.btn-submit').click(function(){
        var tanggal_pesanan = $("#datepicker").val();
        var nama_pelanggan = $("#pelanggan_select").val();
        var bayar = $("#bayar").val();
        // var dp = $(".downPaymentOut").html();

        var raw = $('.downPaymentOut').html().replace(/[^\d,-]/g, '');
        var raw = raw.replace(",", '');
        // var status = $('#status_peralatan').val();
        // alert(raw);
        // return false;
        var statusAlat = $("#status_peralatan").val();
        var peralatan = $('#table-penyewaan tr').length;

         if (tanggal_pesanan == '') {
           alertSubmit1();
           return false;
         }else if (nama_pelanggan == '') {
          alertSubmit2();
          return false;
        }else if (bayar == '') {
          alertSubmit3();
          return false;
        }else if (parseInt(bayar) < parseInt(raw) ) {
          alertSubmit5();
          return false;
        }else if ((statusAlat == 1) && (peralatan == 1)) {
            alertSubmit4();
            return false;
        }else {
           return true;
         }


      });

       $('#harga_menu').on('change', function(){
              var qty = $(this).val();
          //  Ketika Quantity diisi -1
            if (qty < 0) {
            qty=0;
            $('#harga_menu').val(qty);

        }
            });

       $('#jenis_pesanan').on('change', function(){
              setCode();
            });

        // Chosen.js Untuk tambah Menu
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
            });




    // Button Dekete di Tabel Pesanan

     $("#tabel-pesanan").on('click','.btnDelete',function(){
       var rowCount = $('#tabel-pesanan tr').length;

        var currow = $(this).closest('tr');
        var col2 = currow.find('td:eq(1)').text();


        if (col2 == 1) {

        $('#multiCollapseExample2').collapse('hide')
        $('#id_peralatan').attr('disabled', true);
        $('#stock').attr('readonly', true);

        }

        if(rowCount == '2'){
          $('#bayar').attr('readonly', true);
           $('#btn-submit').attr('disabled', true);
           $('.tambah-transaksi').attr('disabled', true);
        }

        $(this).closest('tr').remove();
        $('#harga').text('0');
        $('#subtotal').text('0');
        // $("input[type=text], textarea").val("");
        $('#quantity').attr('readonly', true);


        grandtotal();


     });



      // Ketika Quantity di tambah atau dikurang
    $('#quantity').on('change',function(){
     var qty = $(this).val();
     var jenis = $('#jenis').val();

     if (jenis === 'Tumpeng') {
        if (qty<5) {
          qty=5;
          $('#quantity').val(qty);

        }
     }else {
        if (qty<35) {
          qty=35;
          $('#quantity').val(qty);

        }
     }

    //  Ketika Quantity diisi -1

     var harga = $('#harga').html();
     $('#subtotal').html(parseInt(harga)*qty);
    });



    // DatePicker
      $( "#datepicker" ).datepicker({
               dateFormat: "dd-mm-yy",
                minDate: "+0d +0w"
             });

        $( "#tanggal_penyewaan" ).datepicker({
          dateFormat: "dd-mm-yy",
          maxDate: "+0d +0w"
        });

    $('.js-example-basic-multiple').select2();
    $('.select-peralatan').select2();


     // on Change Pelanggan
    $('#pelanggan_select').on('change', function () {
        var id = $(this).val();
				console.log($(this).val());
        $.ajax({
          type: "get",
          url: "pelanggan/"+id,
          success: function (response) {
						// console.log(response);
            $('#alamat').val(response.alamat);
            $('#no_telepon').val(response.no_telepon);
          }
        });
    });

    // JQUERY Ketika Mengklik button Aksi Menu

    $('.table tbody').on('click','.btnMenu',function(){
      // Membuat form Quantity menjadi tidak Read only
      $('#quantity').attr('readonly', false);
      $('.tambah-transaksi').attr('disabled', false);
      //  $(window).scrollTop(0);

      // Mendapatkan Value berdasarkan <tr>
      var currow = $(this).closest('tr');
      var col1 = currow.find('td:eq(0)').text();
      var col2 = currow.find('td:eq(1)').text();
      var col3 = currow.find('td:eq(2)').text();
      var col4 = currow.find('td:eq(3)').text();
      var col5 = currow.find('td:eq(4)').text();
      var col6 = currow.find('td:eq(5)').text();
      var col9 = currow.find('td:eq(6)').text();
      var col7 = currow.find('td:eq(7)').text();
      var col8 = currow.find('td:eq(8)').text();

       if (col8 == 1) {
         $('#multiCollapseExample2').collapse('show');
        $('#id_peralatan').attr('disabled', false);
        $('#stock').attr('readonly', false);
      }


      // Mengisi Form Pesanan berdasarkan Row yang di pilih
      $('#id_menu').val(col2);
      $('#nama_menu').val(col3);
      $('#jenis').val(col5);
      $('#harga').text(col9);
      $('#status_peralatan').val(col8);

      if (col5 === 'Tumpeng') {
        $('#quantity').val('5');
        $('#subtotal').html(col9*5);
      }else {
        $('#quantity').val('35');
        $('#subtotal').html(col9*35);
      }


      // alert(result);


    });


        // Get Harga List Makanan

        var harga = 0;
        $('#list-makanan').on('change',function (e) {

          var ids = $('#list-makanan').val();
          $.ajax({
            type: "get",
            url: "{{ url('admin/menu/calculate-harga') }}/"+ids,
            success: function (harga) {
              $('#harga_menu').val(harga);

            }
          });


        });


    // Tambah Transaksi

      $(".tambah-transaksi").click(function(){
            var id_menu = $("#id_menu").val();
            var nama_menu = $("#nama_menu").val();
            var jenis = $("#jenis").val();
            var subtotal = $("#subtotal").html();
            var quantity = $("#quantity").val();
            var status = $("#status_peralatan").val();
            var harga = $("#harga").html();
            var markup = "<tr><td style='display:none;'><input type='hidden' class='id_peralatan' name='id_menu[]' value='"+id_menu+"'><div class='id-menu'>"+ id_menu +"</div></td><td style='display:none;'><input type='hidden' name='status_peralatan[]' value='"+status+"'><div class='id-menu'>"+ status +"</div></td><td><input type='hidden' name='nama_menu[]' value='"+nama_menu+"'><div class='nama-menu'>"+ nama_menu +"</div></td><td><input type='hidden' name='jenis_pesanan[]' value='"+jenis+"'>" + jenis + "</td><td><input type='hidden' name='quantity[]' class='quantityInput' value='"+quantity+"'><div class='qty'>" + quantity  + "</div></td><td><input type='hidden' name='harga[]' value='"+harga+"'><div class='harga'>"+ harga +"</div></td><td><input type='hidden' name='subtotal[]' class='subtotalInput' value='"+subtotal+"'><div class='subtotal'>"+ subtotal +"</div></td><td><button type='button' class='btn btn-danger btnDelete'>Delete</button></td></tr>";
            var rowCount = $('#tabel-pesanan tr').length;
            var sama = 0;

          // Cek Apakah Menu Sudah dipilih

            if (nama_menu == '') {

              // Alert Jika Tambah Transaksi di Klik tetapi Menu Belum dipilih
              sweet();

            } else {
                $('.btn-submit').attr('disabled', false);

               if(rowCount > 1){

              $('#tabel-pesanan tr').each(function(){
                var nama = $(this).find(".nama-menu").html();
                if(nama_menu == nama ){

                  sama++;
                    var q = $(this).find(".qty").html();
                    var s = $(this).find(".subtotal").html();

                    $(this).find(".qty").html(parseInt(q) + parseInt(quantity));
                    $(this).find(".quantityInput").val(parseInt(q) + parseInt(quantity));
                    $(this).find(".subtotal").html(parseInt(s) + parseInt(subtotal));
                    $(this).find(".subtotalInput").val(parseInt(s) + parseInt(subtotal));
                    clearForm();
                    grandtotal();

                    return false;
                  }


              });


            }else{
               $("#tabel-pesanan tbody").append(markup);
                 clearForm();
                 grandtotal();

            }
            if(sama == 0 && rowCount > 1){
              $("#tabel-pesanan tbody").append(markup);
                clearForm();
                grandtotal();

            }

            }

        });


      // get Perlengkapan ketika select
      $('#id_peralatan').on('change', function () {
        var id = $(this).val();

        $.ajax({
            type: "get",
            url: "{{url('/admin/get_peralatan')}}/"+id,
            success: function (response) {

                $('#stock').attr('readonly', false);
                $('#button_tambah').attr('disabled', false);
                $('#id_peralatan').val(response.id_peralatan);
                $('#nama_peralatan').val(response.nama_peralatan);
                $('#stock').val(response.stocks.tersedia);
                $('#stock_ghost').val(response.stocks.tersedia);


            }
        });
      });


      $('#stock').on('change', function () {
            var stok = $(this).val();


            if (stok < 0) {
            $(this).val(0);
            }else{

            }
      });


      // Button Tambah Peralatan di Klik
        $('#button_tambah').on('click', function () {
            var id_peralatan = $('#id_peralatan').val();
            var nama = $('#nama_peralatan').val();
            var stock = $('#stock').val();
            var stock_ghost = $('#stock_ghost').val();
            var harga = $('#harga').val();
            var subtotal = stock * harga;
            var getSubtotal = $('#subtotal').val(subtotal);
            var sama = 0;
            var row = "<tr><td style='display:none;'><input type='hidden' name='id_peralatan[]' value='"+id_peralatan+"'></td><td style='display:none;'><input type='hidden' name='stock[]' value='"+stock_ghost+"'></td><td><div class='nama-menu'>"+nama+"</div><input type='hidden' name='nama_peralatan[]' value='"+nama+"'></td><td><div class='stock'>"+stock+"</div><input type='hidden' name='jumlah_sewa[]' value='"+stock+"'></td><td><button type='button' class='btn btn-danger btnDeletePeralatan'>x</button></td></tr>";
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
                      $('#button_tambah').attr('disabled', true);
                        // formDisabled();
                        // grandtotal();

                        return false;
                        }


                    });

                }else{

                    $('#table-penyewaan tbody').append(row);
                      $('#button_tambah').attr('disabled', true);
                    // formDisabled();
                    // grandtotal();
                }

                if(sama == 0 && rowCount > 1){

                    $('#table-penyewaan tbody').append(row);
                      $('#button_tambah').attr('disabled', true);
                    // formDisabled();
                    // grandtotal();

                }

            }


        });

        // Button X di Klik

     $("#table-penyewaan").on('click','.btnDeletePeralatan',function(){
       var rowCount = $('#table-penyewaan tr').length;

        // if(rowCount == '2'){
           $('#button_tambah').attr('disabled', true);
        //    $('.tambah_transaksi').attr('disabled', true);
        // }

        $(this).closest('tr').remove();



     });


        // FUNCTION

         // Alert
          function alertSubmit1 (){
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Pilih Tanggal Terlebih Dahulu!',

            });
          }
          function alertSubmit2 (){
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Pilih Pelanggan Terlebih Dahulu!',

            });
          }
           function alertSubmit3 (){
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Isi Jumlah Bayar terlebih Dahulu!',

            });
          }
            function alertSubmit4 (){
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Isi Peralatan terlebih Dahulu!',
            });
          }
           function alertSubmit5 (){
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Jumlah Bayar harus sesuai dengan uang muka !',
            });
          }

          function alertStock() {
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Stock tidak Cukup!',

            });
          }

          function clearForm()
          {
             $('#bayar').attr('readonly', false);
             $('#harga').text('0');
             $('#subtotal').text('0');
             $('#nama_menu').val('');
             $('#jenis').val('');
             $('#quantity').attr('readonly', true);
             $('.tambah-transaksi').attr('disabled', true);
          }



          function grandtotal()
          {
            var sum =0;
            var title2 = 0;
            $('#tabel-pesanan tbody tr').each(function(){
            title2 += $(this).find("td:eq(1)").text();
            sum += parseInt($('.subtotal',$(this)).text());
          });
            $('.grandtotal').html(sum).formatCurrency()
            var raw = $('.grandtotal').html().replace(/[^\d,-]/g, '');
            var raw = raw.replace(",", '');
            var status = $('#status_peralatan').val();

            if (title2 >= 1) {
              var dp = 60/100*raw;
            }else if(title2 == 0 ) {
              var dp = 40/100*raw;
            }



             $('.total_harga').val(raw);
            $('.downPaymentOut').html(dp).formatCurrency();
             $('.downPayment').val(dp);
             $('#bayar').val(dp);


          }

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

@extends('pesanan.form')


