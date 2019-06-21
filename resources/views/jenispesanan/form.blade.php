{{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah')
    Tambah Data Jenis Pesanan
    @endsection

    @section('formTambah')
  <form action="{{ action('JenisPesananController@store') }}" method="POST" enctype="multipart/form-data">

    {{ csrf_field() }}

    <div class="form-group">
      <label for="nama_jenis_pesanan">Nama Jenis Pesanan</label>
      <input type="text" name="nama_jenis_pesanan" id="nama_jenis_pesanan "  class="form-control"  placeholder="Masukkan Nama Jenis Pesanan" >
    </div>

     <div class="form-group">
      <label for="kode">Kode</label>
      <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan Kode Jenis Pesanan" value="{{ @$result->kode }}" >
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