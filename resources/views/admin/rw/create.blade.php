@extends('admin.layout.app')
@section('title', 'Tambah Data RW')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Tambah Data RW @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-rw.index') }}">Data RW</a></li>
        <li class="breadcrumb-item">Tambah Data RW</li>
    @endslot

    @slot('title') Data RW @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-rw.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>RW<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Nama Ketua RW<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name_pic" value="{{ old('name_pic') }}">
            </div>

            <div class="form-group">
                <label>Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label>Keterangan<span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection