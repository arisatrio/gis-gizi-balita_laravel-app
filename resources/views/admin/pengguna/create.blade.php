@extends('admin.layout.app')
@section('title', 'Tambah Data Pengguna')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Tambah Data Pengguna @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-pengguna.index') }}">Data Pengguna</a></li>
        <li class="breadcrumb-item">Tambah Data Pengguna</li>
    @endslot

    @slot('title') Data Pengguna @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-pengguna.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Role<span class="text-danger">*</span></label>
                <select class="form-control" name="role">
                    <option selected disabled hidden>-- Pilih Role --</option>
                    <option value="Admin">Admin</option>
                    <option value="Tenaga Kesehatan">Tenaga Kesehatan</option>
                    <option value="Masyarakat">Masyarakat</option>
                </select>
            </div>

            <hr>

            <div class="form-group">
                <label>Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>E-Mail<span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>No. Telepon<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label>Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label>Status<span class="text-danger">*</span></label>
                <select class="form-control" name="tb_posyandu_id">
                    <option value="Active" default>Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="card-footer">
                <small>Password User: <b>123456</b></small>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection