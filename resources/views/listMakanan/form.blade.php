{{------------------------------------- Form Tambah List Makanan----------------------------------}}

    @section('modaltitleTambah')
    Tambah Data Makanan
    @endsection

    @section('formTambah')
  <form action="{{ action('ListMakananController@store') }}" method="POST">

    {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_makanan">Nama Makanan/Minuman</label>
      <input type="text" name="nama_makanan" id="nama_makanan "  class="form-control"  placeholder="Masukkan Nama Makanan/Minuman" >
    </div>

    <div class="form-group">
        <label for="">Jenis Makanan/Minuman</label>
        <select name="id_jenis_makanan" class="form-control {{ $errors->has('id_jenis_makanan') ? 'is-invalid':'' }}" id="jenis_makanan" required>
            @foreach ($jenisMakanan as $row)
        <option value="{{ $row->id_jenis_makanan }}">{{ $row->nama_jenis_makanan }}</option>
        @endforeach
        </select>
         <p class="text-danger">{{ $errors->first('id_jenis_makanan') }}</p>
    </div>


    @endsection

{{------------------------------------- Form Tambah Jenis Makanan----------------------------------}}


    @section('modaltitleTambah2')
    Tambah Data Jenis Makanan
    @endsection

    @section('formTambah2')
  <form action="{{ action('ListMakananController@storeJenis') }}" method="POST">

    {{ csrf_field() }}
    <div class="form-group">
      <label for="nama_jenis_makanan">Nama Jenis Makanan</label>
      <input type="text" name="nama_jenis_makanan" id="nama_jenis_makanan "  class="form-control"  placeholder="Masukkan Nama Jenis Makanan" >
    </div>



    @endsection

    {{------------------------------------- Form Edit ----------------------------------}}


    @section('modaltitleEdit')
    Tambah Data Jenis Makanan
    @endsection

    @section('formEdit')
  <form action="{{ action('ListMakananController@store') }}" method="POST" id="editForm">

    {{ csrf_field() }}
    {{ method_field('GET') }}
    <div class="form-group">
      <label for="nama_makanan">Nama</label>
      <input type="nama_makanan" name="nama_makanan" id="nama_makanan" class="form-control" id="nama_makanan" placeholder="Masukkan Nama Pelanggan" >
    </div>

    <div class="form-group">

       <label for="jenis_makanan">Jenis Makanan</label>
     <select name="id_jenis_makanan"  class="form-control {{ $errors->has('id_jenis_makanan') ? 'is-invalid':'' }}"  required>
        @foreach (\App\JenisListMakanan::all() as $jenis_pesanan)
      <option value="{{ $jenis_pesanan->id_jenis_makanan }}">{{ $jenis_pesanan->nama_jenis_makanan }}</option>
      @endforeach
      </select>
      <p class="text-danger">{{ $errors->first('id_jenis_makanan') }}</p>
       </div>


    @endsection


    @section('modaltitleEdit2')
    Tambah Data Jenis Makanan
    @endsection

    @section('formEdit2')
  <form action="{{ action('ListMakananController@store') }}" method="POST" id="editForm2">

    {{ csrf_field() }}
    {{ method_field('GET') }}
    <div class="form-group">
      <label for="nama_jenis_makanan">Nama Jenis Makanan</label>
      <input type="nama_jenis_makanan" name="nama_jenis_makanan" id="nama_jenis_makanan" class="form-control" placeholder="Masukkan Nama Pelanggan" >
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

       @section('modaltitleDelete2')
    Delete Data Pelanggan
    @endsection

    @section('formDelete2')
  <form action="/pelanggan" method="POST" id="deleteForm2">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="_method" value="DELETE">
    <p>Apakah Anda Yakin ingin menghapus Data ini ?</p>


    @endsection