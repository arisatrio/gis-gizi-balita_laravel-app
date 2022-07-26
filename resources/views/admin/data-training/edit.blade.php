@extends('admin.layout.app')
@section('title', 'Edit Data Training')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Edit Data Training @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">SWM Klasifikasi</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-training.index') }}">Data Training</a></li>
        <li class="breadcrumb-item">Edit Data Training</li>
    @endslot

    @slot('title') Form Data Training @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-training.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <option selected disabled hidden>--Pilih Jenis Kelamin--</option>
                    <option value="L" @if($data->jk === 'L') selected @endif>L</option>
                    <option value="P" @if($data->jk === 'P') selected @endif>P</option>
                </select>
            </div>

            <div class="form-group">
                <label>Umur <small>dalam bulan</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umur" value="{{ $data->umur }}">
            </div>

            <div class="form-group">
                <label>Berat Badan (BB) <small>kg</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="bb" value="{{ $data->bb }}">
            </div>

            <div class="form-group">
                <label for="">Status Gizi (BB/U)</label>
                <select name="status" id="status" class="form-control">
                    <option selected disabled hidden>--Pilih Status Gizi--</option>
                    <option value="buruk" @if($data->status === 'buruk') selected @endif>Buruk</option>
                    <option value="kurang" @if($data->status === 'kurang') selected @endif>Kurang</option>
                    <option value="baik" @if($data->status === 'baik') selected @endif>Baik</option>
                    <option value="lebih" @if($data->status === 'lebih') selected @endif>Lebih</option>
                </select>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection