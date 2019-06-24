
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