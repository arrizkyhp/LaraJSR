@extends('layouts.back.master')

@section('title')
<title>Edit Menu | Jembar Sari Rasa</title>
@endsection
@push('script')

<script src="{{ asset('vendors/chosen/chosen.jquery.min.js')  }}"></script>
    <script type="text/javascript">

$(document).ready(function () {


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
                       Edit <strong>List Makanan/Minuman</strong>

                   @endslot
                      <form action="{{ route('list_makanan.update', $listMakanan->id_list_makanan) }}" method="POST">

                         {{ csrf_field() }}
                         {{ method_field('PATCH') }}


                        <div class="form-group">
                        <label for="nama_makanan">Nama Makanan/Minuman </label>
                        <input type="text" name="nama_makanan" id="nama_makanan "  class="form-control {{ $errors->has('nama_makanan') ? 'is-invalid':'' }}" value="{{ $listMakanan->nama_makanan }}"  placeholder="Masukkan Nama Makanan" required>
                        <p class="text-danger">{{ $errors->first('nama_makanan') }}</p>
                        </div>

                          <div class="form-group">
                                    <label for="">Jenis Makanan</label>
                                    <select name="id_jenis_makanan" class="form-control {{ $errors->has('id_jenis_makanan') ? 'is-invalid':'' }}" required  >
                                        <option value="{{ $listMakanan->id_jenis_makanan }}">{{ $listMakanan->jenis_makanan->nama_jenis_makanan }}</option>
                                        @foreach (\App\JenisListMakanan::all() as $jenis_makanan)
                                        <option value="{{ $jenis_makanan->id_jenis_makanan }}">{{ $jenis_makanan->nama_jenis_makanan }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('id_jenis_makanan') }}</p>
                                </div>



                         <div class="form-group">
                        <label for="harga">Harga</label>
                           <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                        <input type="number" name="harga" id="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" value="{{ $listMakanan->harga }}" id="harga" id="number" min="0" placeholder="Masukkan Harga Menu" required>
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


