@extends('admin.layout.app')
@section('title', 'Dashboard')

@section('main-content')
    <div class="content-wrapper" style="min-height: 784px;">
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-3 col-6">    
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalPosyandu }}</h3>
                                <p>Total Posyandu</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <a href="#" class="small-box-footer"></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 class="text-white">{{ $totalBalita }}</h3>
                                <p class="text-white">Total Balita</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-baby"></i>
                            </div>
                            <a href="#" class="small-box-footer"></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalGiziBaik }}</h3>
                                <p>Total Gizi Baik</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <a href="#" class="small-box-footer"></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalGiziBuruk }}</h3>
                                <p>Total Gizi Buruk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-minus"></i>
                            </div>
                            <a href="#" class="small-box-footer"></a>
                        </div>
                    </div>
                </div>
    
    
                <div class="row">
                    <section class="col-lg-8">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Gizi Balita Per Posyandu
                                </h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" width="400" height="190"></canvas> 
                            </div>
                        </div>
                    </section>
                    <section class="col-lg-4">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move;">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Persentase Gizi Balita
                                </h3>
                            </div>
                            <div class="card-body" width="400" height="180">
                                <canvas id="myChart2"></canvas> 
                            </div>
                        </div>
                    </section>
                </div>
    
    
            </div>
        </div>
    </section>    
</div>
@endsection

@push('js')
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js?v=3.2.0') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var labels  = @json($labels);
        var data    = @json($data);
        var dataPie = @json($dataPie);
        
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, 
                datasets: data
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true 
                    },
                    y: {
                        stacked: true 
                    }
                }
            }
        });

        const ctx2 = document.getElementById('myChart2').getContext('2d');
                const myChart2 = new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Gizi Baik',
                            'Gizi Buruk',
                            'Belum Diklasifikasi'
                        ],
                        datasets: [{
                            data: dataPie,
                            backgroundColor: ['#28a745', '#dc3545', 'grey'],
                            hoverOffset: 5
                        }]
                    },

                });

        </script>
        
@endpush