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
{{--
    <div class="form-group">
      <label for="satuan">Satuan</label>
      <input type="text" name="satuan" id="satuan "  class="form-control"  placeholder="Masukkan Satuan (contoh = 'pcs')" >
    </div> --}}

      <div class="form-group">
        <label for="">Satuan</label>
          <select name="satuan" class="form-control {{ $errors->has('id_satuan') ? 'is-invalid':'' }}" id="satuan" required>
                @foreach ($satuan as $one)
              <option value="{{ $one->id_satuan }}">{{ $one->nama_satuan }}</option>
              @endforeach
              </select>
              <p class="text-danger">{{ $errors->first('id_satuan') }}</p>
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

    {{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah2')
    Tambah Data Satuan
    @endsection

    @section('formTambah2')
  <form action="{{ action('PeralatanController@storeSatuan') }}" method="GET">

    {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_satuan">Nama Satuan</label>
      <input type="text" name="nama_satuan" id="nama_satuan "  class="form-control"  placeholder="Masukkan Nama satuan" >
    </div>

    <div class="form-group">
    <label for="nama_satuan">List Satuan</label>
    </div>
     <div class="table-responsive">
       <table class="table table-bordered  table-striped table-hover">
         <thead>
           <tr>
             <th>#</th>
             <th>Nama Satuan</th>
           </tr>
         </thead>
         <tbody>
             @php $no = 1; @endphp
             @foreach ($satuan as $one)
             <tr>
               <td>{{ $no++ }}</td>
               <td>{{ $one->nama_satuan }}</td>
              </tr>
             @endforeach

         </tbody>
       </table>
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
      <label for="tersedia">Tersedia</label>
      <input type="number" name="tersedia" min="0"  id="tersedia" class="form-control" placeholder="Masukkan tersedia">
    </div>

    <div class="form-group">
      <label for="keluar">Keluar</label>
      <input type="number" name="keluar" min="0"  id="keluar" class="form-control" placeholder="Masukkan keluar">
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