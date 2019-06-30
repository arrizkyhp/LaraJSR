@extends('layouts.back.master')

@section('title')
<title>Edit Pesanan | Jembar Sari Rasa</title>
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
                        <h1>Edit Pesanan</h1>
                        <b><span>{{ $pesanan->id_pesanan }}</span></b>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="/admin/dashboard">Dashboard </a>/<a href="/admin/pesanan"> Pesanan</a><a href="/admin/list_pesanan"> / List Pesanan </a>/ Edit Pesanan</li>
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
             <form role="form" action="{{ route('pesanan.update', $pesanan->id_pesanan) }}" id="form-submit" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            {{--------------- Detail Pesanan -----------------}}

             <div class="col-lg-8">
                 <div class="card">
              <div class="card-body">
                    <div class="form-row">

                        <div class="form-group col-lg-5">
                          <label for="alamat">Tanggal Pesanan</label>
                           <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                          <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">
                           <input type="text" name="tanggal_pesanan" id="datepicker" class="form-control" autocomplete="off" value="{{ date('d-m-Y', strtotime($pesanan->tanggal_pesanan)) }}" >
                          </div>
                        </div>
                        <div class="form-group col-lg-7">

                        <label for="nama_pelanggan">Nama Pelanggan</label><a href="http://" style="float:right;" data-toggle="modal" data-target="#exampleModal">Tambah Pelanggan Baru</a>
                        {{-- <input type="nama_pelanggan" name="nama_pelanggan" id="nama_pelanggan" class="form-control" id="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" > --}}
                         <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <select name="id_pelanggan" data-placeholder="Masukan Nama Pelanggan.." class="form-control js-example-basic-multiple" tabindex="1" id="pelanggan_select" style="width: 80%">

                                    @foreach ($pelanggan as $pelanggans)
                                        <option value="{{ $pelanggans->id_pelanggan }}" {{ $pesanan->id_pelanggan == $pelanggans->id_pelanggan ?  'selected' : '' }}  >{{ $pelanggans->nama_pelanggan }}</option>
                                        @endforeach
                        </select>
                      </div>
                        </div>

                         <div class="form-group col-lg-7">
                        <label for="alamat">Alamat</label>
                        <input type="alamat" id="alamat" class="form-control" id="alamat"  value="{{ $pesanan->pelanggan->alamat }}" readonly>
                        </div>

                        <div class="form-group col-lg-5">

                        <label for="no_telepon">No Telepon</label>
                        <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                        <input type="number" id="no_telepon" class="form-control"  type="number"  min="0" type="number" value="{{ $pesanan->pelanggan->no_telepon }}" readonly>
                        </div>
                        </div>

                        <div class="table-responsive">
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
                              @foreach ($detailPesanan as $d)
                                <tr>
                                  <td style='display:none;'>
                                      <input type='hidden' name='id_detail_pesanan[]' value='{{ $d->id_detail_pesanan }}'>
                                      <input type='hidden' name='id_menu[]' value='{{ $d->id_menu }}'>
                                      <div class='id-menu'>{{ $d->id_menu }}</div>
                                  </td>
                                  <td>
                                      <input type='hidden' name='nama_menu[]' value='{{ $d->menu->nama_menu }}'>
                                      <div class='nama-menu'>{{ $d->menu->nama_menu }}</div>
                                  </td>
                                  <td>
                                      <input type='hidden' name='jenis_pesanan[]' value='{{ $d->menu->jenis_pesanan->nama_jenis_pesanan }}'>
                                      {{ $d->menu->jenis_pesanan->nama_jenis_pesanan }}
                                  </td>
                                  <td>
                                      <input type='hidden' class="quantity" name='quantity[]' value='{{ $d->quantity }}' >
                                      <div class='qty'>{{ $d->quantity }}</div>
                                  </td>
                                  <td>
                                      <input type='hidden' name='harga[]' value='{{ $d->harga }}'>
                                      <div class='harga'>{{ $d->harga }}</div>
                                  </td>
                                  <td>
                                      <input type='hidden' class="subtotal_input" name='subtotal[]' value='{{ $d->subtotal }}' >
                                      <input type='hidden' class="status_peralatan" name='status_peralatan[]' value='{{ $d->menu->status_peralatan }}' >
                                      <div class='subtotal'>{{ $d->subtotal }}</div>
                                  </td>

                                  <td>
                                      <button type='button' class='btn btn-danger btnDelete'>Delete</button>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        {{-- teu bisa ka kanan --}}
                        {{-- Rupiah --}}
                        <div class="col-lg-8">
                        <textarea cols="25" rows="3" placeholder="Keterangan (jika ada)" name="keterangan">{{ $pesanan->keterangan }}</textarea>
                        </div>
                             <div class="form-group col-lg-4" >
                             <div style="float:right;">
                        <span>Total Harga </span><h2>Rp.<b><span class="grandtotal" class="text-right">{{ number_format($pesanan->total_harga,0,',', '.') }}</span></b></h2>
                        <input type='hidden' name='total_harga' class="total_harga" value="{{ $pesanan->total_harga }}">
                         </div>
                    </div>

                    <div class="form-group col-lg-12" >
                             <div style="float:right;">
                        <span>Bayar (Rp)</span>
                        <input type="number" id="bayar" value="{{ $jumlahBayar }}" name="bayar" class="form-control col-lg-8" min="0" style="float:right;" readonly>
                         </div>
                    </div>

                    <div class="form-group col-lg-12">
                      {{-- <button type="button" class="btn btn-primary hasil-pesanan" style="float:right;">Hasil</button> --}}
                          <button type="submit" class="btn btn-primary btn-submit" id="btn-submit" style="float:right;" >Simpan</button>
                          <button type="button" class="btn btn-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pilih Menu</b>
                    </div>

                    </div>


            </div>
              </div>


                   <div class="collapse multi-collapse" id="multiCollapseExample1">
                    @card
                   @slot('header')
                        Data <strong>Menu</strong>
                        <button type="button" class="btn btn-info" style="float:right;" data-toggle="modal" data-target="#exampleModal2"><i class="fa fa-plus-square"></i> Tambah Menu Baru</button>
                   @endslot
                  <div class="table-responsive">
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
                          <th style="display:none;">Status Peralatan</th>
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
                          <th style="display:none;">Status Peralatan</th>
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
                          <td style="display:none;">{{ $row->status_peralatan }}</td>
                        </tr>
                          @endforeach
                          </tbody>

                    </table>
                  </div>

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

            {{-- Card Peralatan --}}

             @if ($prasmananStatus != null)
              <div class="collapse.show multi-collapse" id="multiCollapseExample2">
            @else
              <div class="collapse multi-collapse" id="multiCollapseExample2">
            @endif


              <div class="col-lg-4">
                <div class="card">
                  <div class="card-header">
                    <strong class="card-title">Peralatan</strong>
                  </div>

                  <div class="card-body">
                    <input type="hidden" id="id_menu">
                    <div class="form-group ">
											<label for="">Peralatan</label>
											  <select id="id_peralatan" name="id_peralatan" data-placeholder="Nama Peralatan.." class="form-control select-peralatan" tabindex="1" id="peralatan_select" style="width: 100%" {{ $prasmananStatus != null ? '' : 'disabled' }}>
                            <option value=""></option>
                            @foreach ($peralatan as $peralatans)
                            <option value="{{ $peralatans->id_peralatan }}">{{ $peralatans->nama_peralatan }} - {{ $peralatans->tersedia }}</option>
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
                      <input type="hidden" id="tersedia" class="form-control col-lg-4" min="0" style="float:right;" readonly ><br>
                    </div>

                    <div class="form-group"  >
                      <button type="button" id="button_tambah" class="btn btn-primary btn-add pull-right" {{ $prasmananStatus != null ? '' : 'disabled' }} >Tambah</button><br><br>
                      <div class="table-responsve">
                       <table id="table-penyewaan" class="table table-bordered table-stripped">
                          <thead>
                              <tr>
                              <th>Nama Peralatan</th>
                              <th>Qty</th>
                              <th>Tersedia</th>
                              <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($prasmanan as $p)
                            <tr>
                              <td style='display:none;'><input type='hidden' name='id_peralatan[{{$loop->index}}]' value='{{ $p->id_peralatan }}'><input type='hidden' name='tambah[{{$loop->index}}]' value="{{ $p->peralatan->stock }}"></td>
                              <td style='display:none;'><input type='hidden' name='tersedia[{{$loop->index}}]' value='{{ $p->peralatan->tersedia}}'></td>
                              <td><div class='nama-menu'>{{ $p->peralatan->nama_peralatan }}</div><input type='hidden' name='nama_peralatan[{{$loop->index}}]' value='{{ $p->peralatan->nama_peralatan }}'></td>
                              <td><div class='stock'>{{ $p->jumlah_peralatan }}</div><input type='hidden' class='jumlah_sewa' name='jumlah_sewa[{{$loop->index}}]' value='{{ $p->jumlah_peralatan }}'></td>
                              <td><div class='tersedia'>{{ $p->peralatan->tersedia }}</div><input type='hidden' class='jumlah_tersedia' name='jumlah_tersedia[{{$loop->index}}]' value='{{ $p->peralatan->tersedia }}'></td>
                              <td><button type='button' class='btn btn-danger btnDeletePeralatan'>x</button></td>
                            </tr>
                            @endforeach

                          </tbody>
                        </table>
                        </div>
										</div>
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
      // $('body').toggleClass('open');
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

            var selectedId = '{{ $selectedId }}';
            var selectedArr = selectedId.split(',');
            $('#list-makanan').val(selectedArr);
            $('.standardSelect').trigger('chosen:updated');

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


    // Button Dekete di Tabel Pesanan

     $("#tabel-pesanan").on('click','.btnDelete',function(){
       var rowCount = $('#tabel-pesanan tr').length;

        if(rowCount == '2'){

           $('#btn-submit').attr('disabled', true);
           $('.tambah-transaksi').attr('disabled', true);
        }

        $(this).closest('tr').remove();
        $('#harga').text('0');
        $('#subtotal').text('0');
        $('#nama_menu').val('');
        $('#jenis').val('');
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
    $('.select-peralatan').select2();


     // on Change Pelanggan
    $('#pelanggan_select').on('change', function () {
        var id = $(this).val();
				console.log($(this).val());
        $.ajax({
          type: "get",
          url: "/admin/pelanggan/"+id,
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
      var col7 = currow.find('td:eq(7)').text();

       if (col7 == 1) {
         $('#multiCollapseExample2').collapse('show');
        $('#id_peralatan').attr('disabled', false);
        $('#stock').attr('readonly', false);
      }

      // Mengisi Form Pesanan berdasarkan Row yang di pilih
      $('#id_menu').val(col2);
      $('#nama_menu').val(col3);
      $('#jenis').val(col4);
      $('#status_peralatan').val(col7);
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
            var status = $("#status_peralatan").val();
            var harga = $("#harga").html();
            var markup = "<tr><td style='display:none;'><input type='hidden' name='id_menu[]' value='"+id_menu+"'><div class='id-menu'>"+ id_menu +"</div></td><td style='display:none;'><input type='hidden' name='status_peralatan[]' value='"+status+"'><div class='id-menu'>"+ status +"</div></td><td><input type='hidden' name='nama_menu[]' value='"+nama_menu+"'><div class='nama-menu'>"+ nama_menu +"</div></td><td><input type='hidden' name='jenis_pesanan[]' value='"+jenis+"'>" + jenis + "</td><td><input type='hidden' name='quantity[]' value='"+quantity+"' class='quantity'><div class='qty'>" + quantity  + "</div></td><td><input type='hidden' name='harga[]' value='"+harga+"'><div class='harga'>"+ harga +"</div></td><td><input type='hidden' name='subtotal[]' value='"+subtotal+"'><div class='subtotal'>"+ subtotal +"</div></td><td><button type='button' class='btn btn-danger btnDelete'>Delete</button></td></tr>";
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
                    $(this).find(".quantity").val(parseInt(q) + parseInt(quantity));
                    $(this).find(".subtotal").html(parseInt(s) + parseInt(subtotal));
                    $(this).find(".subtotal_input").val(parseInt(s) + parseInt(subtotal));



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
                $('#stock').val(response.tersedia);
                $('#stock_ghost').val(response.tersedia);
                $('#tersedia').val(response.tersedia);


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
            var stockis = $('#tambah').val();
            var stockTable = $('.stock').val();
            var stock_ghost = $('#stock_ghost').val();
            var tersedia = stock_ghost - stock;
            var harga = $('#harga').val();
            var sama = 0;
            var row = "<tr><td style='display:none;'><input type='hidden' name='id_peralatan[]' value='"+id_peralatan+"'></td><td style='display:none;'><input type='hidden' name='stock[]' value='"+stock_ghost+"'></td><td><div class='nama-menu'>"+nama+"</div><input type='hidden' name='nama_peralatan[]' value='"+nama+"'></td><td><div class='stock'>"+stock+"</div><input type='hidden' class='jumlah_sewa' name='jumlah_sewa[]' value='"+stock+"'></td><td><div class='tersedia'>"+tersedia+"</div><input type='hidden' class='jumlah_tersedia' name='jumlah_tersedia[]' value='"+tersedia+"'></td><td><button type='button' class='btn btn-danger btnDeletePeralatan'>x</button></td></tr>";
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
                    var x = $(this).find(".tersedia").html();

                    $(this).find(".stock").html(parseInt(q) + parseInt(stock));
                    $(this).find(".tersedia").html(parseInt(x) - parseInt(stock));
                    $(this).find(".jumlah_sewa").val(parseInt(q) + parseInt(stock));
                    $(this).find(".jumlah_tersedia").val(parseInt(x) - parseInt(stock));


                    alert(hitungStock);
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

           function alertStock() {
          swal.fire({
              type: 'error',
              title: 'Oops...',
              text: 'Stock tidak Cukup!',

            });
          }

          function clearForm()
          {

             $('#harga').text('0');
             $('#subtotal').text('0');
             $('#nama_menu').val('');
             $('#jenis').val('');
            //  $("input[type=text], textarea").val("");
             $('#quantity').attr('readonly', true);
             $('.tambah-transaksi').attr('disabled', true);
          }



          function grandtotal()
          {
            var sum =0;
            var tambah =0;
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


