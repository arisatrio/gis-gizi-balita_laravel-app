@extends('admin.layout.app')
@section('title', 'Tambah Data Training')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Tambah Data Training @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">SWM Klasifikasi</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-training.index') }}">Data Training</a></li>
        <li class="breadcrumb-item">Tambah Data Training</li>
    @endslot

    @slot('title') Form Data Training @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-training.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <option selected disabled hidden>--Pilih Jenis Kelamin--</option>
                    <option value="1">L</option>
                    <option value="0">P</option>
                </select>
            </div>

            <div class="form-group">
                <label>Umur <small>dalam bulan</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umur" value="{{ old('umur') }}">
            </div>

            <div class="form-group">
                <label>Berat Badan (BB) <small>kg</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="bb" value="{{ old('bb') }}">
            </div>

            <div class="form-group">
                <label for="">Status Gizi (BB/U)</label>
                <select name="status" id="status" class="form-control">
                    <option selected disabled hidden>--Pilih Status Gizi--</option>
                    <option value="1">Gizi Baik</option>
                    <option value="0">Gizi Buruk</option>
                </select>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection