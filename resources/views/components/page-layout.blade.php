<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $pageTitle }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        {{ $breadcrumb }}
                    </ol>
                </div>
            </div>
            {{-- <x-_admin.messages /> --}}
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <h3 class="col-6 card-title">{{ $title }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $body }}
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </section>
</div>