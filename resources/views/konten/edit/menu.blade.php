@extends('layouts.back.master')

@section('title')
<title>Edit Konten Menu | Jembar Sari Rasa</title>
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
                            <li class="active root-ajj"><a href="/admin/dashboard">Dashboard</a> / <a href="/admin/konten">Konten</a> / Edit Konten Menu</li>
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
                      <form action="{{ route('konten.menuupdate', $menuKonten->id_konten) }}" method="POST" enctype="multipart/form-data">

                         {{ csrf_field() }}
                         {{ method_field('PATCH') }}

                        <div class="form-group">
                        <label for="nama_konten">Nama Menu </label>
                        <input type="text" name="nama_konten" id="nama_konten "  class="form-control {{ $errors->has('nama_konten') ? 'is-invalid':'' }}" value="{{ $menuKonten->nama_konten }}"  placeholder="Masukkan Nama Konten Menu" required>
                        <p class="text-danger">{{ $errors->first('nama_konten') }}</p>
                        </div>

                        <div class="form-group">
                            <label for="">Jenis Pesanan</label>
                            <select name="id_jenis_pesanan" class="form-control {{ $errors->has('id_jenis_pesanan') ? 'is-invalid':'' }}" required >
                                <option value="{{ $menuKonten->id_jenis_pesanan }}">{{ $menuKonten->jenis->nama_jenis_pesanan }}</option>
                                @foreach (\App\JenisPesanan::all() as $jenis_pesanan)
                                <option value="{{ $jenis_pesanan->id_jenis_pesanan }}">{{ $jenis_pesanan->nama_jenis_pesanan }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('id_jenis_pesanan') }}</p>
                        </div>


                         <div class="form-group">
                        <label for="deskripsi">Deskripsi </label>
                        <textarea type="text" name="deskripsi" id="deskripsi "  class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" placeholder="Masukkan deskripsi (jika ada)" >{{$menuKonten->deskripsi }}</textarea>
                        <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                        </div>

                         <div class="form-group">
                        <label for="foto">Foto</label><br>
                        <img src="{{ asset('uploads/'.@$menuKonten->foto) }}" width="80px" ><br>
                        <input type="file" name="foto"  class="form-control" >
                        </div>


                      @slot('footer')
                     <button class="btn btn-primary" ><i class="fa fa-send"></i> Tambah </button>
                        @endslot
                      @endcard

                   </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection


