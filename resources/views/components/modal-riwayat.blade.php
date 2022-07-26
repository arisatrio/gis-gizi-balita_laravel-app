<div class="card card-primary card-outline card-tabs">

    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">
                    Check Up
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                <table class="table table-bordered">
                    <tr>
                        <th class="bg-light" style="width: 50%;">No. KIA</th>
                        <td>{{ $balita->id_kia }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Nama</th>
                        <td>{{ $balita->name }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Tanggal Lahir</th>
                        <td>{{ $balita->birth->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Umur</th>
                        <td>{{ $balita->age }} / {{ $balita->fullAge }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Jenis Kelamin</th>
                        <td>{{ $balita->gender }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Nama Ibu</th>
                        <td>{{ $balita->parent->name }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Alamat</th>
                        <td>{{ $balita->address }}</td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Posyandu</th>
                        <td><span class="badge badge-primary">{{ $balita->posyandu->name }}</span></td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Total Check Up</th>
                        <td><span class="badge badge-dark">{{ $balita->checkUp->count() }}</span></td>
                    </tr>
                    <tr>
                        <th class="bg-light" style="width: 50%;">Status Gizi (BB/U)</th>
                        <td>
                            @if($balita->status === 1)
                                <span class="badge badge-success">Gizi Baik</span>
                            @elseif($balita->status === 0)
                                <span class="badge badge-danger">Gizi Buruk</span>
                            @else
                                <span class="badge badge-dark">Belum Diklasifikasi</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                @if($balita->checkUp->count() == 0)
                    <span class="badge badge-warning">Belum pernah Check Up</span>
                @endif

                @foreach ($balita->checkUp as $item)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $item->check_date->formatLocalized('%d %B %Y') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    
                    <div class="card-body" style="display: block;">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-12">
                                <div class="info-box">
                                    @if($item->status != NULL)
                                        @if($item->status === 1)
                                            <span class="info-box-icon bg-success"><i class="far fa-thumbs-up"></i></span>
                                            <div class="info-box-content">
                                                <span class="h1 info-box-number text-uppercase">Gizi Baik</span>
                                            </div>
                                        @else
                                            <span class="info-box-icon bg-danger"><i class="far fa-flag"></i></span>
                                            <div class="info-box-content">
                                                <span class="h1 info-box-number text-uppercase">Gizi Buruk</span>
                                            </div>
                                        @endif
                                    @else
                                        <span class="info-box-icon bg-warning"><i class="far fa-star"></i></span>
                                        <div class="info-box-content">
                                            <span class="h1 info-box-number text-uppercase">Belum diklasifikasi</span>
                                        </div>
                                    @endif
                                
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Berat Badan (BB)</span>
                                        <span class="h4 info-box-number">{{ $item->bb }} <small>kg</small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tinggi Badan (TB)</span>
                                        <span class="h4 info-box-number">{{ $item->tb }} <small>cm</small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Lingkar Kepala (LK)</span>
                                        <span class="h4 info-box-number">{{ $item->lk }} <small>cm</small></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <span class="info-box-text">Lingkar Dada (LD)</span>
                                        <span class="h4 info-box-number">{{ $item->ld }} <small>cm</small></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
                @endforeach

            </div>
        </div>
    </div>
    
</div>