<aside class="main-sidebar sidebar-dark-gray elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link text-center">
      <span class="brand-text font-weight-bold text-center">KLAZITA</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
          </div>
          <div class="info">
              <a href="{{ route('profile.index') }}" class="d-block text-uppercase">{{ auth()->user()->name }}</a>
          </div>
          <div class="info d-flex ml-auto">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-block text-danger"><i class="fas fa-sign-out-alt"></i></a>
          </div>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header text-uppercase">Dashboard</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard-map') }}" class="nav-link {{  Route::is('admin.dashbord-map.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-map"></i>
                        <p>Dashboard Maps</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{  Route::is('admin.dashbord-map.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-chart-area"></i>
                        <p>Dashboard Analytics</p>
                    </a>
                </li>

                @if(auth()->user()->role == 'Admin')
                    <li class="nav-header text-uppercase">SVM Klasifikasi</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.data-training.index') }}" class="nav-link {{  Route::is('admin.data-training.*') ? 'active' : ''  }}">
                            <i class="nav-icon fas fa-brain"></i>
                            <p>Training</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.data-normalisasi.index') }}" class="nav-link {{  Route::is('admin.data-normalisasi.*') ? 'active' : ''  }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>Normalisasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.data-testing.index') }}" class="nav-link {{  Route::is('admin.data-testing.*') ? 'active' : ''  }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Testing</p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->role == 'Masyarakat')
                    <li class="nav-header text-uppercase">Balita</li>
                    <li class="nav-item">
                        <a href="{{ route('user.balita-saya.index') }}" class="nav-link {{  Route::is('user.balita-saya.*') ? 'active' : ''  }}">
                            <i class="nav-icon fas fa-baby"></i>
                            <p>Balita Saya</p>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'Tenaga Kesehatan')
                <li class="nav-header text-uppercase">Check Up</li>
                <li class="nav-item">
                    <a href="{{ route('admin.data-check-up.index') }}" class="nav-link {{  Route::is('admin.data-check-up.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-baby"></i>
                        <p>Data Check Up</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data-balita.index') }}" class="nav-link {{  Route::is('admin.data-balita.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-baby"></i>
                        <p>Data Balita</p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'Admin')
                <li class="nav-header text-uppercase">Master</li>
                <li class="nav-item">
                    <a href="{{ route('admin.data-pengguna.index') }}" class="nav-link {{  Route::is('admin.data-pengguna.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data-posyandu.index') }}" class="nav-link {{  Route::is('admin.data-posyandu.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Posyandu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data-rw.index') }}" class="nav-link {{  Route::is('admin.data-rw.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data RW</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.data-lokasi.index') }}" class="nav-link {{  Route::is('admin.data-lokasi.*') ? 'active' : ''  }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Data Lokasi</p>
                    </a>
                </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>