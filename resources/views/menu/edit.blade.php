@extends('layouts.back.master')

@section('title')
<title>Edit Menu | Jembar Sari Rasa</title>
@endsection
@push('script')

<script src="{{ asset('vendors/chosen/chosen.jquery.min.js')  }}"></script>
    <script type="text/javascript">

$(document).ready(function () {

            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
            var selectedId = '{{ $selectedId }}';
            var selectedArr = selectedId.split(',');
            $('#list_makanan').val(selectedArr);
            $('.standardSelect').trigger('chosen:updated');

 });
    </script>
@endpush

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
                            <li class="active root-ajj"><a href="/admin/dashboard">Dashboard</a> / <a href="/admin/menu">Menu</a> / Edit Menu</li>
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
                       Edit <strong>Menu</strong>

                   @endslot
                      <form action="{{ route('menu.update', $menu->id_menu) }}" method="POST">

                         {{ csrf_field() }}
                         {{ method_field('PATCH') }}
                        <div class="form-group">
                        <label for="id_menu">Kode Menu </label>
                        <input type="text" name="id_menu" id="id_menu" class="form-control {{ $errors->has('id_menu') ? 'is-invalid':'' }}" value="{{ $menu->id_menu }}"   placeholder="Masukkan Kode Menu" readonly>
                        <p class="text-danger">{{ $errors->first('id_menu') }}</p>
                        </div>

                        <div class="form-group">
                        <label for="nama_menu">Nama Menu </label>
                        <input type="text" name="nama_menu" id="nama_menu "  class="form-control {{ $errors->has('nama_menu') ? 'is-invalid':'' }}" value="{{ $menu->nama_menu }}"  placeholder="Masukkan Nama Menu" required>
                        <p class="text-danger">{{ $errors->first('nama_menu') }}</p>
                        </div>

                          <div class="form-group">
                                    <label for="">Jenis Pesanan</label>
                                    <select name="id_jenis_pesanan" class="form-control {{ $errors->has('id_jenis_pesanan') ? 'is-invalid':'' }}" required readonly>
                                        <option value="{{ $menu->id_jenis_pesanan }}">{{ $menu->jenis_pesanan->nama_jenis_pesanan }}</option>
                                        @foreach (\App\JenisPesanan::all() as $jenis_pesanan)
                                        <option value="{{ $jenis_pesanan->id_jenis_pesanan }}">{{ $jenis_pesanan->nama_jenis_pesanan }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('id_jenis_pesanan') }}</p>
                                </div>

                        <div class="form-group">
                        <label for="Deskripsi">List Makanan/Minuman</label>
                            <select name="id_list_makanan[]" data-placeholder="Pilih List..." multiple class="standardSelect" id="list_makanan">
                                @foreach ($listMakanan as $detail_menu)
                                    <option value="{{ $detail_menu->id_list_makanan }}" >{{ $detail_menu->nama_makanan}}</option>
                                 @endforeach
                            </select>

                        </div>

                         <div class="form-group">
                        <label for="keterangan">Keterangan </label>
                        <textarea type="text" name="keterangan" id="keterangan "  class="form-control {{ $errors->has('keterangan') ? 'is-invalid':'' }}" placeholder="Masukkan Keterangan (jika ada)" >{{$menu->keterangan }}</textarea>
                        <p class="text-danger">{{ $errors->first('keterangan') }}</p>
                        </div>

                         <div class="form-group">
                        <label for="harga">Harga</label>
                           <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                        <input type="number" name="harga" id="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" value="{{ $menu->harga }}" id="harga" id="number" min="0" placeholder="Masukkan Harga Menu" required>
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


