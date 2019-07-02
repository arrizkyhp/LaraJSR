@extends('layouts.back.master')

@section('title')
<title>Edit Peralatan | Jembar Sari Rasa</title>
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
                        <h1>Edit Peralatan</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="/admin/dashboard">Dashboard</a> / <a href="/admin/peralatan">Menu</a> / Edit Peralatan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

              <div class="col-lg-12">
                   @card
                   @slot('header')
                       Edit <strong>Menu</strong>

                   @endslot
                      <form action="{{ route('peralatan.update', $peralatan->id_peralatan) }}" method="POST">

                         {{ csrf_field() }}
                         {{ method_field('PATCH') }}
                        <div class="form-group">
                            <label for="nama_peralatan">Nama</label>
                                <input type="text" name="nama_peralatan" value="{{ $peralatan->nama_peralatan }}" id="nama_peralatan" class="form-control {{ $errors->has('id_peralatan') ? 'is-invalid':'' }}"  id="nama_peralatan" placeholder="Masukkan Nama Pelanggan" >
                                <p class="text-danger">{{ $errors->first('id_menu') }}</p>
                            </div>

                            <div class="form-group">
                            <label for="satuan">Satuan</label>


                             <select name="satuan" class="form-control {{ $errors->has('id_satuan') ? 'is-invalid':'' }}" required >
                                <option value="{{ $peralatan->id_satuan }}">{{ $peralatan->satuan->nama_satuan }}</option>
                                @foreach ($satuan as $one)
                                <option value="{{ $one->id_satuan }}">{{ $one->nama_satuan }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('id_satuan') }}</p>
                            </div>

                            <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" value="{{ $peralatan->stocks->stock }}" min="0"  id="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}" placeholder="Masukkan stock">
                            <p class="text-danger">{{ $errors->first('stock') }}</p>
                            </div>

                            <div class="form-group">
                            <label for="tersedia">Tersedia</label>
                            <input type="number" name="tersedia" value="{{ $peralatan->stocks->tersedia }}" min="0"  id="tersedia" class="form-control {{ $errors->has('tersedia') ? 'is-invalid':'' }}" placeholder="Masukkan tersedia">
                            <p class="text-danger">{{ $errors->first('tersedia') }}</p>
                            </div>

                            <div class="form-group">
                            <label for="keluar">Keluar</label>
                            <input type="number" name="keluar" value="{{ $peralatan->stocks->keluar }}" min="0"  id="keluar" class="form-control {{ $errors->has('keluar') ? 'is-invalid':'' }}" placeholder="Masukkan keluar">
                            <p class="text-danger">{{ $errors->first('keluar') }}</p>
                            </div>

                            <div class="form-group">
                            <label for="harga_sewa">Harga Sewa</label>
                            <input type="number" name="harga_sewa" value="{{ $peralatan->harga_sewa }}" id="harga_sewa"  class="form-control {{ $errors->has('keluar') ? 'is-invalid':'' }}" min="0" placeholder="Masukkan Harga Sewa Peralatan">
                            <p class="text-danger">{{ $errors->first('keluar') }}</p>
                            </div>

                            <div class="form-group">
                            <label for="harga_ganti">Harga Ganti</label>
                            <input type="number" name="harga_ganti" value="{{ $peralatan->harga_ganti }}" id="harga_ganti"  class="form-control {{ $errors->has('keluar') ? 'is-invalid':'' }}" min="0" placeholder="Masukkan Harga Ganti Rugi Peralatan">
                            <p class="text-danger">{{ $errors->first('keluar') }}</p>
                            </div>

                      @slot('footer')
                     <button class="btn btn-primary" ><i class="fa fa-send"></i> Update </button>
                        @endslot
                      @endcard

                   </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection


