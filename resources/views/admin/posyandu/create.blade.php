@extends('admin.layout.app')
@section('title', 'Tambah Data Posyandu')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Tambah Data Posyandu @endslot
    @slot('breadcrumb')
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item"><a href="{{ route('admin.data-posyandu.index') }}">Data Posyandu</a></li>
        <li class="breadcrumb-item">Tambah Data Posyandu</li>
    @endslot

    @slot('title') Data Posyandu @endslot

    @slot('body')
        <x-messages />
        
        <form action="{{ route('admin.data-posyandu.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Posyandu<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label>Nama Ketua Posyandu<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name_pic" value="{{ old('name_pic') }}">
            </div>

            <div class="form-group">
                <label>RW<span class="text-danger">*</span></label>
                <select class="form-control" name="tb_rukun_warga_id">
                    <option selected disabled hidden>-- Pilih RW --</option>
                    @foreach ($rukun_warga as $rw)
                    <option value="{{ $rw->id }}">{{ $rw->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Lokasi<span class="text-danger">*</span></label>
                <div id="map"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
            </div>
            
            <div class="form-group">
                <label>Alamat<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label>Status<span class="text-danger">*</span></label>
                <select class="form-control" name="status">
                    <option value="active" selected>Aktif</option>
                    <option value="inactive">TIdak Aktif</option>
                </select>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
        </form>
        
    @endslot
</x-page-layout>
@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="crossorigin=""/>
    <style>
            #map { height: 500px; }
    </style>
@endpush
@push('js')
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="crossorigin=""></script>
<script>
    const map = L.map('map');
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const polygon = L.polygon(@json($lokasi->border)).addTo(map).setStyle({color: 'black'});
    const center = polygon.getBounds().getCenter();
    map.setView(center, 15);

    var theMarker = {};

    map.on('click',function(e){
        lat = e.latlng.lat;
        lon = e.latlng.lng;

        if (theMarker != undefined) {
                map.removeLayer(theMarker);
        };

        theMarker = L.marker([lat,lon]).addTo(map);  
        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lon;
    });

</script>
@endpush