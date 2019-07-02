{{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah')
    Tambah Konten
    @endsection

    @section('formTambah')
  <form action="{{ action('KontenController@store') }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
      <label for="nama_konten">Nama Konten</label>
      <input type="text" name="nama_konten" id="nama_konten "  class="form-control"  placeholder="Masukkan Nama Konten" >
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
      <label for="deskripsi">Deskripsi</label>
     <textarea class="form-control" name="deskripsi"  id="deskripsi" rows="4"></textarea>
  </div>


    <div class="form-group">
      <label for="foto">Foto</label>
      <input type="file" name="foto" id="foto "  class="form-control" >
    </div>


    @endsection

    {{------------------------------------- Form Edit ----------------------------------}}


    @section('modaltitleEdit')
    Edit Data Jenis Pesanan
    @endsection

    @section('formEdit')



    @endsection

        {{------------------------------------- Form Delete ----------------------------------}}


    @section('modaltitleDelete')
    Delete Data Pelanggan
    @endsection

    @section('formDelete')
  <form action="/jenispesanan" method="POST" id="deleteForm">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="_method" value="DELETE">
    <p>Apakah Anda Yakin ingin menghapus Data ini ?</p>


    @endsection