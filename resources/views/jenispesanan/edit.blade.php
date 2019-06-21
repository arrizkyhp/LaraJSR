@extends('layouts.back.master')

@section('title')
<title>Jenis Pesanan | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Jenis Pesanan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="/dashboard">Dashboard</a> / <a href="/jenis_pesanan">Jenis Pesanan</a> / Edit Jenis Pesanan</li>
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
                       Edit Data <strong>Jenis Pesanan</strong>

                   @endslot
                    <form action="{{ url("/admin/jenis_pesanan/$result->id_jenis_pesanan/edit") }}" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                    <label for="nama_jenis_pesanan">Nama Jenis Pesanan</label>
                    <input type="text" name="nama_jenis_pesanan" id="nama_jenis_pesanan" class="form-control" placeholder="Masukkan Jenis Pesanan" value="{{ @$result->nama_jenis_pesanan }}" >
                    </div>

                    <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan Kode Jenis Pesanan" value="{{ @$result->kode }}" >
                    </div>

                    <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi"  id="deskripsi" rows="4" placeholder="Masukkan Jenis Pesanan">{{ @$result->deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                    <label for="foto">Foto</label><br>
                    <img src="{{ asset('uploads/'.@$result->foto) }}" width="80px" ><br>
                    <input type="file" name="foto"  class="form-control" >
                    </div>


                   <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                    </form>

                      @slot('footer')

                        @endslot
                      @endcard


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection

    {{-------------------------------------------- SCRIPT MODAL ------------------------------------}}



