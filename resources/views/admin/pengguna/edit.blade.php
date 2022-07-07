@extends('admin.layout.app')
@section('title', 'Edit Data Pengguna')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Edit Data Pengguna @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-pengguna.index') }}">Data Pengguna</a></li>
        <li class="breadcrumb-item">Edit Data Pengguna</li>
    @endslot

    @slot('title') Data Pengguna @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-pengguna.update', $data_pengguna->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Role<span class="text-danger">*</span></label>
                <select class="form-control" name="role">
                    <option selected disabled hidden>-- Pilih Role --</option>
                    <option @if($data_pengguna->role === 'Admin') selected @endif value="Admin">Admin</option>
                    <option @if($data_pengguna->role === 'Tenaga Kesehatan') selected @endif value="Tenaga Kesehatan">Tenaga Kesehatan</option>
                    <option @if($data_pengguna->role === 'Masyarakat') selected @endif value="Masyarakat">Masyarakat</option>
                </select>
            </div>

            <hr>

            <div class="form-group">
                <label>Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $data_pengguna->name }}">
            </div>

            <div class="form-group">
                <label>E-Mail<span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ $data_pengguna->email }}">
            </div>

            <div class="form-group">
                <label>No. Telepon<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="phone" value="{{ $data_pengguna->phone }}">
            </div>

            <div class="form-group">
                <label>Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="5">{{ $data_pengguna->address }}</textarea>
            </div>

            <div class="form-group">
                <label>Status<span class="text-danger">*</span></label>
                <select class="form-control" name="tb_posyandu_id">
                    <option @if($data_pengguna->status === 'Active') selected @endif value="Active" default>Active</option>
                    <option @if($data_pengguna->status === 'Inactive') selected @endif value="Inactive">Inactive</option>
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