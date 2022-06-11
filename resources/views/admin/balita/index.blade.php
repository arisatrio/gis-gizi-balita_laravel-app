@extends('admin.layout.app')
@section('title', 'Data Balita')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Data Balita @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-balita.index') }}">Data Balita</a></li>
    @endslot

    @slot('title') Data Balita @endslot

    @slot('body')
        <x-messages />

        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('admin.data-balita.create') }}" class="btn btn-success float-right"> <i class="fas fa-plus"></i> Tambah Data Balita</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-datatables>
                    @slot('columns')
                        <th>KIA</th>
                        <th>Nama</th>
                        <th style="width: 5%;">JK</th>
                        <th>Umur</th>
                        <th>Nama Ibu</th>
                        <th>Posyandu</th>
                        <th>Terakhir Cek</th>
                    @endslot
                </x-datatables>
            </div>
        </div>
        

        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Riwayat</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
            <p>One fine body…</p>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            
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
            {data: 'id_kia', name: 'id_kia'},
            {data: 'name', name: 'name'},
            {data: 'gender', name: 'gender'},
            {data: 'age', name: 'age'},
            {data: 'mother_name', name: 'mother_name'},
            {data: 'posyandu', name: 'posyandu'},
            {data: 'last_check', name: 'last_check'},
            {data: 'action', name: 'action', orderable: false, seacrhable: false}
        ],
        columnDefs: [
            {
                "targets": 3,
                "className": "text-center",
            },
            {
                "targets": 6,
                "className": "text-center",
            },
            {
                "targets": 8,
                "className": "text-center",
            },
        ]
    });

    function delete_balita(e) {
        var url = '{{ route("admin.data-balita.destroy", ":id") }}';
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