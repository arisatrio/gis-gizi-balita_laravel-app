@extends('admin.layout.app')
@section('title', 'Tambah Data Balita')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Tambah Data Balita @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-balita.index') }}">Data Balita</a></li>
        <li class="breadcrumb-item">Tambah Data Balita</li>
    @endslot

    @slot('title') Data Balita @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-balita.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Posyandu<span class="text-danger">*</span></label>
                <select class="form-control" name="tb_posyandu_id">
                    <option selected disabled hidden>-- Pilih Posyandu --</option>
                    @foreach ($posyandu as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nama Orang Tua<span class="text-danger">*</span></label>
                <select class="form-control" name="parent_id" id="parent_id">
                    <option selected disabled hidden>-- Cari Orang Tua --</option>
                    @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <hr>

            <div class="form-group">
                <label>NO. Kartu Identitas Anak (KIA)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="id_kia" value="{{ old('id_kia') }}">
            </div>

            <div class="form-group">
                <label>Nama Balita<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="birth" value="{{ old('birth') }}">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin<span class="text-danger">*</span></label>
                <select class="form-control" name="gender">
                    <option selected disabled hidden>-- Pilih Jenis Kelamin --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="5"></textarea>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#parent_id').select2();
        });
    </script>
@endpush