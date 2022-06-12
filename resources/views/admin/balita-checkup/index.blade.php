@extends('admin.layout.app')
@section('title', 'Data Check Up')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Data Check Up @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-check-up.index') }}">Data Check Up</a></li>
    @endslot

    @slot('title') Data Check Up @endslot

    @slot('body')
        <x-messages />

        <div class="row">
            <div class="col">
                <x-datatables>
                    @slot('columns')
                        <th style="width: 20%;">Tangal</th>
                        <th style="width: 20%;">Posyandu</th>
                        <th>No. KIA</th>
                        <th>Nama</th>
                        <th class="none">JK</th>
                        <th class="none">Umur</th>
                        <th class="none">BB</th>
                        <th class="none">TB</th>
                        <th class="none">LK</th>
                        <th class="none">LD</th>
                        <th class="none">Status Gizi</th>
                    @endslot
                </x-datatables>
            </div>
        </div>
        @include('admin.layout._modal-riwayat')

    @endslot
</x-page-layout>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var datatable = $('#datatables').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'check_date', name: 'check_date'},
            {data: 'posyandu', name: 'posyandu'},
            {data: 'balita.id_kia', name: 'balita.id_kia'},
            {data: 'balita.name', name: 'balita.name'},
            {data: 'balita.gender', name: 'balita.gender'},
            {data: 'age', name: 'age'},
            {data: 'bb', name: 'bb'},
            {data: 'tb', name: 'tb'},
            {data: 'lk', name: 'lk'},
            {data: 'ld', name: 'ld'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, seacrhable: false}
        ],
        columnDefs: [
            {
                "targets": 12,
                "className": "text-center",
            },
        ]
    });

    function delete_checkup(e) {
        var url = '{{ route("admin.data-check-up.destroy", ":id") }}';
        url = url.replace(':id', e);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title             : "Hapus Data",
            text              : "Apakah Anda yakin akan hapus data ini!?",
            icon              : "warning",
            showCancelButton  : true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor : "#d33",
            confirmButtonText : "Ya, Hapus!"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url    : url,
                    type   : "delete",
                    success: function(data) {
                        $('#datatables').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Data berhasil dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
            }
        })

    }
</script>
@endpush