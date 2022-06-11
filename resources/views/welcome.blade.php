<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> --}}

        <style>
            #map { height: 580px; }
            .leaflet-tooltip-pane .text {
                color: white; 
                font-weight: bold;
                background: transparent;
                border:0;
                box-shadow: none;
                font-size:1em;
            }
        </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="crossorigin=""/>
    </head>
    <body>
            
        <div id="map"></div>

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
                    color: "red",
                    fillColor: "red",
                    fillOpacity: 0.5,
                    radius: 75
                }).addTo(map);
                onecircle.bindPopup('<b>Posyandu '+pos.name+' </b> '+'('+pos.rukun_warga.name+')<br>'+'<small>'+pos.address+'</small>');
                onecircle.bindTooltip("40%", {
                    permanent: true, 
                    direction:"center",
                    className: 'text'
                }).openTooltip();
            });

            console.log(posyandu);

        </script>
    </body>
</html>
