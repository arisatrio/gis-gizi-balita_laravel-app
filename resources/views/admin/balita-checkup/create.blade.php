@extends('admin.layout.app')
@section('title', 'Tambah Data Check Up')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Tambah Data Check Up @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-balita.index') }}">Data Balita</a></li>
        <li class="breadcrumb-item">Tambah Data Check Up</li>
    @endslot

    @slot('title') Form Data Check Up @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.balita-checkup.store') }}" method="POST">
            @csrf

            <input type="hidden" name="tb_balita_id" value="{{ $balita->id }}">

            <div class="form-group">
                <label>Nama Petugas<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly="readonly">
                <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id }}">
            </div>

            <div class="form-group">
                <label>Tanggal Check Up<span class="text-danger">*</span></label>
                <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="check_date" value="{{ old('check_date') }}">
                    <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                        <div class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <label>Nama Balita<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{ $balita->name }}" readonly="readonly">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{ $balita->birth }}" readonly="readonly">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{ $balita->gender }}" readonly="readonly">
            </div>
            <div class="form-group">
                <label>Nama Ibu Balita<span class="text-danger">*</span></label>
                <input type="text" class="form-control" value="{{ $balita->mother_name }}" readonly="readonly">
            </div>

            <hr>

            <div class="form-group">
                <label>Berat Badan (BB) <small>kg</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="bb" value="{{ old('bb') }}">
            </div>

            <div class="form-group">
                <label>Tinggi Badan (TB) <small>cm</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="tb" value="{{ old('tb') }}">
            </div>

            <div class="form-group">
                <label>Lingkar Kepala (LK) <small>cm</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="lk" value="{{ old('lk') }}">
            </div>

            <div class="form-group">
                <label>Lingkar Dada (LD) <small>cm</small><span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="ld" value="{{ old('ld') }}">
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    
@endpush
@push('js')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        $('#reservationdatetime').datetimepicker({
            icons: { time: 'far fa-clock'}
        });
    </script>
@endpush