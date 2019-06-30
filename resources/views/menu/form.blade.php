    {{------------------------------------- Form Tambah ----------------------------------}}

    @section('modaltitleTambah2')
    Tambah Data Menu
    @endsection

    @section('formTambah2')
  <form action="{{ action('MenuController@store') }}" method="POST">

    {{ csrf_field() }}
     <div class="form-group">
                        <label for="id_menu">Kode Menu </label>
                        <input type="text" name="id_menu" id="kode_menu"  class="form-control {{ $errors->has('id_menu') ? 'is-invalid':'' }}"  placeholder="Kode Menu..." required readonly>
                        {{-- <p class="text-danger">{{ $errors->first('id') }}</p> --}}
                        <div class="invalid-feedback">
                        Please choose a username.
                        </div>
                        </div>

                        <div class="form-group">
                        <label for="nama_menu">Nama Menu </label>
                        <input type="text" name="nama_menu" id="nama_menu "  class="form-control {{ $errors->has('nama_menu') ? 'is-invalid':'' }}"  placeholder="Masukkan Nama Menu" required>
                        <p class="text-danger">{{ $errors->first('nama_menu') }}</p>
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
                            <label for="keterangan">Keterangan</label>
                            <textarea type="textarea" class="form-control {{ $errors->has('id_jenis_pesanan') ? 'is-invalid':'' }}" name="keterangan" placeholder="Masukkan Keterangan Menu" ></textarea>
                        </div>


                        <div class="form-group">
                            <label for="Deskripsi">List Makanasn/Minuman</label>
                            <select name="id_list_makanan[]" id="list-makanan" data-placeholder="Pilih List..." multiple class="standardSelect">
                              @foreach ($jenisListMakanan as $jenis)
                                <optgroup label="{{ $jenis->nama_jenis_makanan }}">
                                    @foreach ($getMakanan as $makanan)
                                    @if (($jenis->id_jenis_makanan) == ($makanan->jenis_makanan->id_jenis_makanan))
                                         <option value="{{ $makanan->id_list_makanan }}" data-harga="{{ $makanan->harga }}">{{ $makanan->nama_makanan}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                              @endforeach
                            </select>
                            {{-- <textarea type="textarea" class="form-control {{ $errors->has('id_jenis_pesanan') ? 'is-invalid':'' }}" name="deskripsi" placeholder="Masukkan Deskripsi Menu" required></textarea> --}}
                        </div>



                         <div class="form-group">

                        <label for="harga">Harga</label>
                         <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                        <input type="number" name="harga" id="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}" id="harga" min="0" placeholder="Masukkan Harga Menu" requiired>
                         <p class="text-danger">{{ $errors->first('harga') }}</p>
                         </div>
                        </div>

                        <div class="form-group">

                            <span>Dengan Peralatan ?</span>
                            <input type="hidden" value="0" name="status_peralatan">
                          <label class="switch switch-3d switch-info mr-3"><input type="checkbox" class="switch-input" name="status_peralatan" value="1"> <span class="switch-label"></span> <span class="switch-handle"></span></label>

                        </div>

    @endsection

        {{------------------------------------- Form Delete ----------------------------------}}
    @section('modaltitleDelete')
    Delete Data Pelanggan
    @endsection

    @section('formDelete')
  <form action="/menu" method="POST" id="deleteForm">

    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <input type="hidden" name="_method" value="DELETE">
    <p>Apakah Anda Yakin ingin menghapus Data ini ?</p>


    @endsection