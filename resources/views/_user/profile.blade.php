@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('main-content')
    <div class="content-wrapper" style="min-height: 784px;">
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        
        <section class="content">
            <div class="container-fluid">
                <x-messages />

                <div class="row">

                    <div class="col-7">    
                        <div class="card">
                            <div class="card-header p-2">
                                Profile Saya
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" value="{{ auth()->user()->name }}" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" value="{{ auth()->user()->email }}" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">No. Telp</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" id="inputName2" value="{{ auth()->user()->phone }}" nama="phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" name="address">{{ auth()->user()->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row float-right">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <div class="col-5">
                        <div class="card">
                            <div class="card-header p-2">
                                Ganti Password
                            </div>
                            <div class="card-body">
                                <form action="{{ route('update-password') }}" method="POST">
                                @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputName" name="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputName" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="form-group row float-right">
                                        <div class="col-sm-10">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>        
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
@endsection