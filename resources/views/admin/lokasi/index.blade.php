@extends('admin.layout.app')
@section('title', 'Edit Data Lokasi')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Edit Data Lokasi @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-lokasi.index') }}">Data Lokasi</a></li>
    @endslot

    @slot('title') Data Lokasi @endslot

    @slot('body')
        <x-messages />

        <div class="row mb-2">
            <a href="{{ route('admin.download-geojson') }}" class="col-2 btn btn-primary"><i class="fas fa-download"></i> Template File</a>
        </div>
        
        <form action="{{ route('admin.data-lokasi.update', $data_lokasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Negara<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="country" value="{{ $data_lokasi->country }}" disabled>
            </div>
            <div class="form-group">
                <label>Provinsi<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="province" value="{{ $data_lokasi->province }}" disabled>
            </div>
            <div class="form-group">
                <label>Kabupaten/Kota<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="district" value="{{ $data_lokasi->district }}" disabled>
            </div>
            <div class="form-group">
                <label>Kecamatan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="sub_district" value="{{ $data_lokasi->sub_district }}" disabled>
            </div>
            <div class="form-group">
                <label>Desa/Kelurahan<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="village" value="{{ $data_lokasi->village }}" disabled>
            </div>

            <div class="form-group">
                <label>Upload File <small>(format .geojson)</small><span class="text-danger">*</span></label><br>
                <input class="form-control" type="file" name="polygon" />
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection