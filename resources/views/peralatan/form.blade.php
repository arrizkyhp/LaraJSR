{{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah')
    Tambah Data Peralatan
    @endsection

    @section('formTambah')
  <form action="{{ action('PeralatanController@store') }}" method="POST">

    {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_peralatan">Nama Peralatan</label>
      <input type="text" name="nama_peralatan" id="nama_peralatan "  class="form-control"  placeholder="Masukkan Nama Peralatan" >
    </div>

    <div class="form-group">
      <label for="satuan">Satuan</label>
      <input type="text" name="satuan" id="satuan "  class="form-control"  placeholder="Masukkan Satuan (contoh = 'pcs')" >
    </div>

    <div class="form-group">
      <label for="stock">Stock</label>
      <input type="number" name="stock" min="0"  id="stock " class="form-control" placeholder="Masukkan stock">
    </div>

    <div class="form-group">
      <label for="harga_sewa">Harga Sewa</label>
      <input type="number" name="harga_sewa" id="harga_sewa "  class="form-control" min="0" placeholder="Masukkan Harga Sewa Peralatan">
    </div>

    <div class="form-group">
      <label for="harga_ganti">Harga Ganti</label>
      <input type="number" name="harga_ganti" id="harga_ganti "  class="form-control" min="0" placeholder="Masukkan Harga Ganti Rugi Peralatan">
    </div>


    @endsection

    {{------------------------------------- Form Edit ----------------------------------}}


    @section('modaltitleEdit')
    Edit Data Pelanggan
    @endsection

    @section('formEdit')
  <form action="" method="POST" id="editForm">

    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="nama_peralatan">Nama</label>
      <input type="text" name="nama_peralatan" id="nama_peralatan" class="form-control" id="nama_peralatan" placeholder="Masukkan Nama Pelanggan" >
    </div>

    <div class="form-group">
      <label for="satuan">Satuan</label>
      <input type="text" name="satuan" id="satuan"  class="form-control"  placeholder="Masukkan Satuan (contoh = 'pcs')" >
    </div>

    <div class="form-group">
      <label for="stock">Stock</label>
      <input type="number" name="stock" min="0"  id="stock" class="form-control" placeholder="Masukkan stock">
    </div>

    <div class="form-group">
      <label for="harga_sewa">Harga Sewa</label>
      <input type="number" name="harga_sewa" id="harga_sewa"  class="form-control" min="0" placeholder="Masukkan Harga Sewa Peralatan">
    </div>

    <div class="form-group">
      <label for="harga_ganti">Harga Ganti</label>
      <input type="number" name="harga_ganti" id="harga_ganti"  class="form-control" min="0" placeholder="Masukkan Harga Ganti Rugi Peralatan">
    </div>


    @endsection

        {{------------------------------------- Form Delete ----------------------------------}}


    @section('modaltitleDelete')
    Delete Data Pelanggan
    @endsection

    @section('formDelete')
  <form action="/pelanggan" method="POST" id="deleteForm">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="_method" value="DELETE">
    <p>Apakah Anda Yakin ingin menghapus Data ini ?</p>


    @endsection