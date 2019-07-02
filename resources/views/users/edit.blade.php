@extends('layouts.back.master')

@section('title')
<title>Tambah Users | Jembar Sari Rasa</title>
@endsection

{{-------------------------------------------- KONTEN ------------------------------------}}

@section('content')
 <!-- Header-->
        <div class="breadcrumbs">
            <div class="col-sm-4 head-content">
                <div class="page-header float-left">
                    <div lass="page-title">
                        <h1>Users</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active root-ajj"><a href="#">Dashboard</a> / Users / Tambah Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
                    {{-- @if(count($errors) >0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
            @endif

            @if (\Session::has('success'))
            <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
            </div>
            @endif --}}


        <div class="content mt-3">

              <div class="col-lg-12">
                   @card
                   @slot('header')
                       Tambah <strong>Users</strong>

                   @endslot
                      <form action="{{ route('users.update', $users->id_users) }}" method="POST">

                          {{ csrf_field() }}
                             {{ method_field('PATCH') }}
                         <div class="form-group">
                        <label for="name">Nama </label>
                         <input type="text" name="name" id="name" value="{{ $users->name }}"  class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"  placeholder="Masukkan Nama User" required>
                         <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>


                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                            <option value="0" {{ $users->role == 0 ? 'selected' : ''}}>Admin</option>
                            <option value="1" {{ $users->role == 1 ? 'selected' : ''}}>Manajer Operasional</option>
                            </select>
                        </div>


                        <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" placeholder="Password" >
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        <p class="text-warning">Biarkan kosong, jika tidak ingin mengganti password</p>
                          </div>

                      @slot('footer')
                     <button class="btn btn-primary" ><i class="fa fa-send"></i> Tambah </button>
                        @endslot
                      @endcard

                                   </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection



@extends('pelanggan.form')


