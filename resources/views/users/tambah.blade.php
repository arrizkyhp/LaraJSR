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
                      <form action="{{ route('users.store') }}" method="POST">

                         {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name"  class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}"  placeholder="Masukkan Nama User" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username"  class="form-control {{ $errors->has('username') ? 'is-invalid':'' }}"  placeholder="Masukkan Username " required>
                            <p class="text-danger">{{ $errors->first('username') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" placeholder="Password" required>
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" placeholder="Password Confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="0">Admin</option>
                                    <option value="1">Manajer Operasional</option>
                                </select>
                            </div>
                        </div>

{{--
                        <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid':'' }}" required>
                                        <option value="">Pilih</option>
                                        @foreach ($role as $row)
                                        <option value="{{ $row->name }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{ $errors->first('role') }}</p>
                                </div> --}}

                      @slot('footer')
                     <button class="btn btn-primary" ><i class="fa fa-send"></i> Tambah </button>
                        @endslot
                      @endcard

                                   </form>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    @endsection



@extends('pelanggan.form')


