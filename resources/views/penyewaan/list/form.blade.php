{{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah')
    Tambah Data Pelanggan
    @endsection

    @section('formTambah')
  <form action="{{ action('PelangganController@store') }}" method="POST">

    {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_pelanggan">Nama</label>
      <input type="text" name="nama_pelanggan" id="nama_pelanggan "  class="form-control"  placeholder="Masukkan Nama Pelanggan" >
    </div>

    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="text" name="alamat"  id="alamat " class="form-control" placeholder="Masukkan Alamat">
    </div>

    <div class="form-group">
      <label for="no_telepon">No Telepon</label>
      <input type="number" name="no_telepon" id="no_telepon "  class="form-control" type="number" id="number" min="0" placeholder="Masukkan No Telepon Pelanggan">
    </div>


    @endsection
        {{------------------------------------- Form Delete ----------------------------------}}


    @section('modaltitleDelete')
    Delete Data Pelanggan
    @endsection

    @section('formDelete')
  <form action="" method="POST" id="deleteForm">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="_method" value="DELETE">
    <p>Apakah Anda Yakin ingin menghapus Data ini ?</p>


    @endsection

         {{------------------------------------- Form Konnfirm ----------------------------------}}


    @section('modaltitleKonfirm')
    Pesanan Selesai
    @endsection

    @section('formKonfirm')
  <form action="" method="GET" id="konfirmForm">

    {{ csrf_field() }}
    {{ method_field('GET') }}
    <input type="hidden" name="_method" value="">
    <p>Apakah Sewa Sudah Selesai ?</p>


    @endsection