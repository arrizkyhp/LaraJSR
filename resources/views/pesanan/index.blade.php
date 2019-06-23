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
                  <row>
             <div class="col-lg-8">
                 <div class="card">
              <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-lg-6">
                          <label for="alamat">Tanggal Pesanan</label>
                           <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="" name="tanggal_pesanan" id="datepicker" class="form-control" autocomplete="off" >
                          </div>
                        </div>
                        <div class="form-group col-lg-6">

                        <label for="nama_pelanggan">Nama Pelanggan</label><a href="http://" style="float:right;" data-toggle="modal" data-target="#exampleModal">Tambah Pelanggan Baru</a>
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

                         <div class="form-group col-lg-7">
                        <label for="alamat">Alamat</label>
                        <input type="alamat" id="alamat" class="form-control" id="alamat"  readonly>
                        </div>

                        <div class="form-group col-lg-5">

                        <label for="no_telepon">No Telepon</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                        <input type="no_telepon" id="no_telepon" class="form-control" id="no_telepon" type="number" id="number" min="0" type="number" readonly>
                        </div>
                        </div>




                        <table id="tabel-pesanan" class="table table-striped table-bordered table-hover tabel-responsive tabel-pesanan">
                          <thead>
                            <tr>
                              <th>Nama Menu</th>
                              <th>Jenis Pesanan</th>
                              <th>Quantity</th>
                              <th>Harga</th>
                              <th>Subtotal</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                        {{-- teu bisa ka kanan --}}
                        {{-- Rupiah --}}
                        <div class="col-lg-8">
                          <textarea cols="25" rows="3" placeholder="Keterangan (jika ada)" name="keterangan"></textarea>
                        </div>
                             <div class="form-group col-lg-4" >
                             <div style="float:right;">
                        <span>Total Harga </span><h2>Rp.<b><span class="grandtotal" class="text-right">0</span></b></h2>
                        <input type='hidden' name='total_harga' class="total_harga">
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
                          <button type="button" class="btn btn-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pilih Menu</b>
                    </div>

                    </div>


            </div>
              </div>

              </row>
                   <div class="collapse multi-collapse" id="multiCollapseExample1">
                    @card
                   @slot('header')
                        Data <strong>Menu</strong>
                        <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-plus-square"></i> Tambah Menu Baru</button>
                   @endslot
                      <table id="tabel-data" class="table table-striped table-bordered table-hover " width="100%" cellspacing="0">
                    <thead>
                      <tr>
                       <th>#</th>
                       <th style="display:none;">id</th>
                        <th>Nama Menu</th>
                        <th>Jenis Pesanan</th>
                        <th>List Makanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tfoot>
                     <tr>
                        <th>#</th>
                        <th style="display:none;">id</th>
                        <th>Nama Menu</th>
                        <th>Jenis Pesanan</th>
                        <th>List Makanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                     <tbody>
                         @php $no = 1; @endphp
                        @foreach ($menu as $row)
                      <tr class="sc-product-item">
                      <td>{{ $no++ }}</td>
                      <td style="display:none;">{{ $row->id_menu }}</td>
                       <td >{{ $row->nama_menu }}</td>
                        <td >{{ $row->jenis_pesanan->nama_jenis_pesanan }}</td>
                           <td>
                       @foreach ($row->detail_menu as $detail)
                         <label for="" class="badge badge-info">{{ $detail->list_makanan->nama_makanan }}</label>
                       @endforeach
                       </td>
                        <td>{{ $row->harga }}</td>
                        <td>
                        <button type="button" id="menu_data" class="btn btn-info"><i class="fa fa-plus-square"></i> </button>
												</td>

                      </tr>
                        @endforeach
                         </tbody>

                  </table>

                      @slot('footer')

                        @endslot
                      @endcard
            </div>
          </div>


              {{--------------- Cart-----------------}}

            <div class="col-lg-4">
              <div class="card">
              <div class="card-body">

                  <!-- Cart submit form -->

                    <!-- SmartCart element -->
                    <input type="hidden" id="id_menu">
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
												<input type="number" id="quantity" class="form-control col-lg-4" min="0" style="float:right;" readonly>
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

          </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}

    @push('script')

    <script src="{{ asset('vendors/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
    <script src="{{ asset('vendors/autonumeric/jquery.number.min.js')  }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js')  }}"></script>
    <script src="{{ asset('vendors/chosen/chosen.jquery.min.js')  }}"></script>

    <script type="text/javascript">



    // DataTables

    $(document).ready(function () {
      $('body').toggleClass('open');
      var table = $('#tabel-data').DataTable();
      // $('#harga').number( true, 4 );


      $('.btn-submit').click(function(){
        var tanggal_pesanan = $("#datepicker").val();
        var nama_pelanggan = $("#pelanggan_select").val();

         if (tanggal_pesanan == '') {
           alertSubmit1();
           return false;
         }else if (nama_pelanggan == '') {
          alertSubmit2();
          return false;
        }else {
           return true;
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

        if(rowCount == '2'){
          $('#bayar').attr('readonly', true);
           $('#btn-submit').attr('disabled', true);
           $('.tambah-transaksi').attr('disabled', true);
        }

        $(this).closest('tr').remove();
        $('#harga').text('0');
        $('#subtotal').text('0');
        $("input[type=text], textarea").val("");
        $('#quantity').attr('readonly', true);


        grandtotal();


     });



      // Ketika Quantity di tambah atau dikurang
    $('#quantity').on('change',function(){
     var qty = $(this).val();
    //  Ketika Quantity diisi -1
     if (qty<1) {
      qty=1;
      $('#quantity').val(qty);

    }
     var harga = $('#harga').html();
     $('#subtotal').html(parseInt(harga)*qty);
    });



    // DatePicker
      $( "#datepicker" ).datepicker({
               dateFormat: "dd-mm-yy"
             });

    $('.js-example-basic-multiple').select2();


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

    $('.table tbody').on('click','.btn',function(){
      // Membuat form Quantity menjadi tidak Read only
      $('#quantity').attr('readonly', false);
      $('.tambah-transaksi').attr('disabled', false);

      // Mendapatkan Value berdasarkan <tr>
      var currow = $(this).closest('tr');
      var col1 = currow.find('td:eq(0)').text();
      var col2 = currow.find('td:eq(1)').text();
      var col3 = currow.find('td:eq(2)').text();
      var col4 = currow.find('td:eq(3)').text();
      var col5 = currow.find('td:eq(4)').text();
      var col6 = currow.find('td:eq(5)').text();

      // Mengisi Form Pesanan berdasarkan Row yang di pilih
      $('#id_menu').val(col2);
      $('#nama_menu').val(col3);
      $('#jenis').val(col4);

      $('#harga').text(col6);
      $('#subtotal').html(col6);
      $('#quantity').val('1');



      // alert(result);


    });


    // Tambah Transaksi

      $(".tambah-transaksi").click(function(){
            var id_menu = $("#id_menu").val();
            var nama_menu = $("#nama_menu").val();
            var jenis = $("#jenis").val();
            var subtotal = $("#subtotal").html();
            var quantity = $("#quantity").val();
            var harga = $("#harga").html();
            var markup = "<tr><td style='display:none;'><input type='hidden' name='id_menu[]' value='"+id_menu+"'><div class='id-menu'>"+ id_menu +"</div></td><td><input type='hidden' name='nama_menu[]' value='"+nama_menu+"'><div class='nama-menu'>"+ nama_menu +"</div></td><td><input type='hidden' name='jenis_pesanan[]' value='"+jenis+"'>" + jenis + "</td><td><input type='hidden' name='quantity[]' value='"+quantity+"'><div class='qty'>" + quantity  + "</div></td><td><input type='hidden' name='harga[]' value='"+harga+"'><div class='harga'>"+ harga +"</div></td><td><input type='hidden' name='subtotal[]' value='"+subtotal+"'><div class='subtotal'>"+ subtotal +"</div></td><td><button type='button' class='btn btn-danger btnDelete'>Delete</button></td></tr>";
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
                    $(this).find(".subtotal").html(parseInt(s) + parseInt(subtotal));
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
            $('#tabel-pesanan tbody tr').each(function(){
            sum += parseInt($('.subtotal',$(this)).text());
            // test += $('.subtotal).val(col2);
          });
            $('.grandtotal').html(sum).formatCurrency()
            var raw = $('.grandtotal').html().replace(/[^\d,-]/g, '');
            var raw = raw.replace(",", '');


             $('.total_harga').val(raw);
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


