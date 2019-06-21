{{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah')
    Tambah Users
    @endsection

    @section('formTambah')
  <form action="{{ action('PelangganController@store') }}" method="POST">

    {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_pelanggan">Nama </label>
      <input type="text" name="nama_pelanggan" id="nama_pelanggan "  class="form-control"  placeholder="Masukkan Nama Pelanggan" >
    </div>

       <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" id="email "  class="form-control"  placeholder="Masukkan Nama Pelanggan" >
    </div>

     <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>



    @endsection

    {{------------------------------------- Form Edit ----------------------------------}}


    @section('modaltitleEdit')
    Edit Data Pelanggan
    @endsection

    @section('formEdit')
  <form action="/Pelanggan" method="POST" id="editForm">

    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="nama_pelanggan">Nama</label>
      <input type="nama_pelanggan" name="nama_pelanggan" id="nama_pelanggan" class="form-control" id="nama_pelanggan" placeholder="Masukkan Nama Pelanggan" >
    </div>

    <div class="form-group">
      <label for="alamat">Alamat</label>
      <input type="alamat" name="alamat" id="alamat" class="form-control" id="alamat" placeholder="Masukkan Alamat">
    </div>

    <div class="form-group">
      <label for="no_telepon">No Telepon</label>
      <input type="no_telepon" name="no_telepon" id="no_telepon" class="form-control" id="no_telepon" type="number" id="number" min="0" type="number" placeholder="Masukkan No Telepon Pelanggan">
    </div>


    @endsection

        {{------------------------------------- Form Delete ----------------------------------}}


    @section('modaltitleDelete')
    Delete Data Pelanggan
    @endsection

    @section('formDelete')
  <form action="/users" method="POST" id="deleteForm">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="_method" value="DELETE">
    <p>Apakah Anda Yakin ingin menghapus Data ini ?</p>


    @endsection