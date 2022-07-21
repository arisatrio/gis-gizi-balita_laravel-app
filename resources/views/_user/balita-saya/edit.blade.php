@extends('admin.layout.app')
@section('title', 'Edit Data Balita Saya')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Edit Data Balita Saya @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('user.balita-saya.index') }}">Data Balita Saya</a></li>
        <li class="breadcrumb-item">Edit Data Balita Saya</li>
    @endslot

    @slot('title') Data Balita Saya @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('user.balita-saya.update', $data_balita->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Posyandu<span class="text-danger">*</span></label>
                <select class="form-control" name="tb_posyandu_id">
                    @foreach ($posyandu as $item)
                    <option value="{{ $item->id }}" @if($data_balita->tb_posyandu_id === $item->id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="parent_id" value="{{ auth()->user()->id }}">

            <hr>

            <div class="form-group">
                <label>NO. Kartu Identitas Anak (KIA)<span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="id_kia" value="{{ $data_balita->id_kia }}">
            </div>

            <div class="form-group">
                <label>Nama Balita<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $data_balita->name }}">
            </div>

            <div class="form-group">
                <label>Tanggal Lahir<span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="birth" value="{{ $data_balita->birth->format('Y-m-d') }}">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin<span class="text-danger">*</span></label>
                <select class="form-control" name="gender">
                    <option selected disabled hidden>-- Pilih Jenis Kelamin --</option>
                    <option value="L" @if($data_balita->gender === 'L') selected @endif>Laki-laki</option>
                    <option value="P" @if($data_balita->gender === 'p') selected @endif>Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="5">{{ $data_balita->address }}</textarea>
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