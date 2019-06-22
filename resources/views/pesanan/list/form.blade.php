
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