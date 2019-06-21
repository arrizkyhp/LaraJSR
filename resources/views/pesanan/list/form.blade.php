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

    {{------------------------------------- Form Tambah 2nd ----------------------------------}}

    @section('modaltitleTambah2')
    <span id="id_pesanan"></span>
    @endsection

    @section('formTambah2')

        <div class="form-group">
            <b>Kode :</b> <span>JSR-12312312-001</span><br>
            <span><b>Tgl Pesanan </b>: 12/12/12</span><br>
            <span><b>Nama Pelanggan : </b>Arrizky</span>
        </div>
        <table class="table table-striped table-bordered" id="tabel-modal">
            <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Deskripsi</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
            </thead>
            <tbody>
            <tr id="isi">

            </tr>
            </tbody>
        </table>
          <div class="form-group">
            <span style="float:right;"><b>Subtotal :</b> Rp. 1.000.000</span>

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