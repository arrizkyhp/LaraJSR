@extends('layouts.back.master')

@section('title')
<title>Tambah Menu | Jembar Sari Rasa</title>
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
                            <li class="active root-ajj"><a href="/dashboard">Dashboard</a> / <a href="/menu">Menu</a> / Tambah Menu</li>
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
                       Tambah <strong>Menu</strong>

                   @endslot
                      <form action="{{ route('menu.store') }}" method="POST">

                         {{ csrf_field() }}
                        <div class="form-group">
                        <label for="id">Kode Menu </label>
                        <input type="text" name="id_menu" id="kode_menu"  class="form-control {{ $errors->has('id_menu') ? 'is-invalid':'' }}"  placeholder="Masukkan Kode Menu" required>
                        {{-- <p class="text-danger">{{ $errors->first('id') }}</p> --}}
                        <div class="invalid-feedback">
                        Please choose a username.
                        </div>
                        </div>

                        <div class="form-group">
                        <label for="nama_menu">Nama Menu </label>
                        <input type="text" name="nama_menu" id="nama_menu "  class="form-control {{ $errors->has('nama_menu') ? 'is-invalid':'' }}"  placeholder="Masukkan Nama Menu" required>
                        <p class="text-danger">{{ $errors->first('nama_menu') }}</p>
                        </div>

                        <div class="form-group">
                         <label for="">Jenis Pesanan</label>
                            <select name="id_jenis_pesanan" class="form-control {{ $errors->has('id_jenis_pesanan') ? 'is-invalid':'' }}" id="jenis_pesanan" required>
                                <option value="">Pilih</option>
                                 @foreach (\App\JenisPesanan::all() as $jenis_pesanan)
                                <option value="{{ $jenis_pesanan->id_jenis_pesanan }}">{{ $jenis_pesanan->nama_jenis_pesanan }}</option>
                                @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('id_jenis_pesanan') }}</p>
                        </div>

                        <div class="form-group">
                            <label for="Deskripsi">Deskripsi</label>
                            <textarea type="textarea" class="form-control {{ $errors->has('id_jenis_pesanan') ? 'is-invalid':'' }}" name="deskripsi" placeholder="Masukkan Deskripsi Menu" required></textarea>
                        </div>



                         <div class="form-group">
                        <label for="harga">Harga</label>
                         <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                        <input type="number" name="harga" id="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" id="harga" min="0" placeholder="Masukkan Harga Menu" requiired>
                         <p class="text-danger">{{ $errors->first('harga') }}</p>
                         </div>
                        </div>



                      @slot('footer')
                     <button class="btn btn-primary" ><i class="fa fa-send"></i> Tambah </button>
                        @endslot
                      @endcard

                   </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection

    @push('script')

    <script>
//          $(document).ready(function() {
//          // on Change Pelanggan
//     $('#jenis_pesanan').on('change', function () {
//         var id = $(this).val();
//         $.ajax({
//           type: "get",
//           url: "../jenis_pesanan/"+id,
//           data: "id="+id,
//           dataType: 'json',
//           success: function (response) {
//               var nama_jenis = data[0]
//               console.log(nama_jenis);
//             //      if (id == '12') {
//             //      $('#kode_menu').val('NB');
//             //   } else {
//             //        $('#kode_menu').val('test');
//             //   }

//           }
//         });
//     });
// });
    </script>

    @endpush

