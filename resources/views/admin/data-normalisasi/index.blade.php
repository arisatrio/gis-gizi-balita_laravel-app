@extends('admin.layout.app')
@section('title', 'Data Normalisasi')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Data Normalisasi @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-normalisasi.index') }}">Data Normalisasi</a></li>
    @endslot

    @slot('title') Data Normalisasi @endslot

    @slot('body')
        <x-messages />

        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('admin.generate-normalisasi') }}" class="btn btn-success float-right"> <i class="fas fa-plus"></i> Generate Normalisasi</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table id="datatables" class="table table-bordered table-hover" cellspacing="0" width="100%">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th>Umur Norm</th>
                            <th>JK Norm</th>
                            <th>BB Norm</th>
                            <th>TB Norm</th>
                            <th>LK Norm</th>
                            <th>LD Norm</th>
                            <th>Status Norm</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    @endslot
</x-page-layout>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush
@push('js')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var datatable = $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'umur_norm', name: 'umur_norm'},
            {data: 'jk_norm', name: 'jk_norm'},
            {data: 'bb_norm', name: 'bb_norm'},
            {data: 'tb_norm', name: 'tb_norm'},
            {data: 'lk_norm', name: 'lk_norm'},
            {data: 'ld_norm', name: 'ld_norm'},
            {data: 'status_norm', name: 'status_norm'},
        ],
    });
</script>
@endpush