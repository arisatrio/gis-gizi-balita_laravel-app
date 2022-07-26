@extends('admin.layout.app')
@section('title', 'Data Training')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Data Testing @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-training.index') }}">Data Testing</a></li>
    @endslot

    @slot('title') Data Testing @endslot

    @slot('body')
        <x-messages />

        <div class="row mb-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Parameter Klasifikasi SVM
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.data-testing.store') }}" method="POST">
                        @csrf
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Kernel</label>
                                        <select name="kernel" id="kernel" class="form-control">
                                            <option value="0" selected>RBF</option>
                                            <option value="1">Linear</option>
                                            <option value="2">Polynomial</option>
                                            <option value="3">Sigmoid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">C Parameter</label>
                                    <input type="number" class="form-control" value="1" name="c_param">
                                </div>
                                <div class="col">
                                    <label for="">Derajat</label>
                                    <input type="number" class="form-control" value="3" name="degree">
                                </div>
                                <div class="col">
                                    <label for="">Gamma</label>
                                    <input type="number" class="form-control" value="1" name="gamma">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="">Koefisien 0</label>
                                    <input type="number" class="form-control" value="0" name="coef0">
                                </div>
                                <div class="col">
                                    <label for="">Toleransi</label>
                                    <input type="number" class="form-control" value="0.001" name="tolerance" step="0.001">
                                </div>
                                <div class="col">
                                    <label for="">Iterasi</label>
                                    <input type="number" class="form-control" value="100" name="cache">
                                </div>
                                <div class="col">
                                    <label for="">Jumlah Data Training</label>
                                    <input type="number" class="form-control" name="total_data_to_train" 
                                        @if($totalDataTraining) value="{{ floor($totalDataTraining - ($totalDataTraining/2)) }}"
                                        max="{{ $totalDataTraining }}" @endif
                                        required>
                                </div>
                            </div>
                            <div class="form-row mt-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-success float-right">Proses</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <th style="width: 15%;">Status</th>
                            <th style="width: 15%;">Status Prediksi</th>
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
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'umur_norm', name: 'umur_norm'},
            {data: 'jk_norm', name: 'jk_norm'},
            {data: 'bb_norm', name: 'bb_norm'},
            {data: 'status_norm', name: 'status_norm'},
            {data: 'status_prediksi', name: 'status_prediksi'},
        ],
        columnDefs: [
            {
                "targets": 5,
                "className": "text-center",
            },
        ]
    });
</script>
@endpush