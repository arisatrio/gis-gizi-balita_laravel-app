@extends('admin.layout.app')
@section('title', 'Data Training')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Data Training @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-training.index') }}">Data Training</a></li>
    @endslot

    @slot('title') Data Training @endslot

    @slot('body')
        <x-messages />

        <div class="row mb-2">
            <div class="col">
                <a href="{{ route('admin.data-training.create') }}" class="btn btn-success float-right"> <i class="fas fa-plus"></i> Tambah Data Training</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-datatables>
                    @slot('columns')
                        <th>Umur (Bulan)</th>
                        <th>Jenis Kelamin (JK)</th>
                        <th>Berat Badan (BB)</th>
                        <th>Status (BB/U)</th>
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
            {data: 'umur', name: 'umur'},
            {data: 'jk', name: 'jk'},
            {data: 'bb', name: 'bb'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, seacrhable: false}
        ],
        columnDefs: [
            {
                "targets": 5,
                "className": "text-center",
            },
        ]
    });

    $('body').on('click', '#edit', function (e) {
        $('#modal-default').modal('show');

        var id = $(this).data('id');
        var url = "{{ route('admin.balita-checkup.show',":id") }}";
        url = url.replace(':id', id);

        $.get(url, function (data) {
            $('#modal-body').html(data.html);
        });

    });

    function delete_training(e) {
        var url = '{{ route("admin.data-training.destroy", ":id") }}';
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