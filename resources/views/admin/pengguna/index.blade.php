@extends('admin.layout.app')
@section('title', 'Data Pengguna')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Data Pengguna @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-pengguna.index') }}">Data Pengguna</a></li>
    @endslot

    @slot('title') Data Pengguna @endslot

    @slot('body')
        <x-messages />

        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('admin.data-pengguna.create') }}" class="btn btn-success float-right"> <i class="fas fa-plus"></i> Tambah Data Pengguna</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-datatables>
                    @slot('columns')
                        <th>Role</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th style="width: 5%;">Status</th>
                    @endslot
                </x-datatables>
            </div>
        </div>
        
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
        processing: true,
        serverSide: true,
        ajax: "",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'role', name: 'role'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, seacrhable: false}
        ],
        columnDefs: [
            {
                "targets": 1,
                "className": "text-center",
            },
            {
                "targets": 5,
                "className": "text-center",
            },
            {
                "targets": 6,
                "className": "text-center",
            },
        ]
    });

    function delete_pengguna(e) {
        var url = '{{ route("admin.data-pengguna.destroy", ":id") }}';
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