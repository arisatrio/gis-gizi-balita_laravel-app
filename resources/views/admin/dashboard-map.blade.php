@extends('admin.layout.app')
@section('title', 'Dashboard Map')

@section('main-content')
<x-page-layout>
    @slot('pageTitle') Dashboard Map @endslot
    @slot('breadcrumb')@endslot

    @slot('title') 
        <div class="row">
            <div class="col">
                Dashboard Map 
            </div>
            <div class="col">
                <a href="{{ route('admin.dashboard-map') }}" class="btn btn-success float-right"> <i class="fas fa-sync"></i> Reload</a>

            </div>
        </div>
    @endslot

    @slot('body')
        <x-messages />

        <div class="row">
            <div class="col">
                <div id="map"></div>
            </div>
        </div>
    @endslot

</x-page-layout>
@endsection
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="crossorigin=""/>
    <style>
        #map { 
            height: 500px; 
        }
        .leaflet-tooltip-pane .text {
            color: white; 
            font-weight: bold;
            background: transparent;
            border:0;
            box-shadow: none;
            font-size:1em;
        }
    </style>
@endpush
@push('js')
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="crossorigin=""></script>
    <script>
        L.Mask = L.Polygon.extend({
            options: {
                stroke: false,
                color: '#333',
                fillOpacity: 0.5,
                clickable: true,

                outerBounds: new L.LatLngBounds([-90, -360], [90, 360])
            },
            initialize: function (latLngs, options) {
                
                var outerBoundsLatLngs = [
                    this.options.outerBounds.getSouthWest(),
                    this.options.outerBounds.getNorthWest(),
                    this.options.outerBounds.getNorthEast(),
                    this.options.outerBounds.getSouthEast()
                ];
                L.Polygon.prototype.initialize.call(this, [outerBoundsLatLngs, latLngs], options);	
            },

        });
        L.mask = function (latLngs, options) {
            return new L.Mask(latLngs, options);
        };

        const lokasi = @json($lokasi->border);
        const posyandu = @json($posyandu);

        const map = L.map('map');
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.mask(lokasi).addTo(map);

        const border = L.polygon(lokasi).addTo(map).setStyle({color: 'black'});
        const center = border.getBounds().getCenter();
        map.setView(center, 15);

        posyandu.forEach(function (pos) {
            var onecircle =  L.circle([pos.latitude, pos.longitude], {
                // color: "green",
                // fillColor: "green",
                fillOpacity: 0.5,
                radius: 100
            }).addTo(map);
            var posyandu        = '<b>'+pos.name+'</b><br>'+'<small>'+pos.address+'</small><br><hr>';
            var totalBalita     = '<b>Total Balita: '+pos.balita_count+'</b><br>';
            var totalGiziBaik   = '<b>Gizi Baik: <span style="color:green">'+pos.gizi_baik_count+'</span></b><br>';
            var totalGiziBuruk  = '<b>Gizi Buruk: <span style="color:red">'+pos.gizi_buruk_count+'</span></b><br>';
            var totalGiziBuruk  = '<b>Belum Diklasifikasi: <span style="color:grey">'+pos.belum_klasifikasi_count+'</span></b><br>';
            var persentase      = getPercentGiziBaik(pos.balita_count, pos.gizi_baik_count);
            var persen          = '<b>Persentase: '+persentase+'%</b>';
            onecircle.setStyle({ color: getColor(persentase) });
            // console.log(persentase);
            
            onecircle.bindPopup(posyandu+totalBalita+totalGiziBaik+totalGiziBuruk+persen);
            onecircle.bindTooltip(persentase+' %', {
                permanent: true, 
                direction:"center",
                className: 'text'
            }).openTooltip();
        });

        function getColor(value) {
            hue = value;
            return ["hsl(", hue, ",100%,50%)"].join("");
        }

        function getPercentGiziBaik(totalBalita, totalGiziBaik){
            if(totalBalita != 0 && totalGiziBaik != 0) {
                return ((totalGiziBaik / totalBalita)*100).toFixed(2);
            } else {
                return 0;
            }
        }
    </script>
@endpush