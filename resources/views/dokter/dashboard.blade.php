{{-- resources/views/dokter/dashboard.blade.php --}}
@include('layout.header', ['title' => 'Dashboard Dokter'])

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item menu-open">
      <a href="{{ route('dashboardDokter') }}" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('jadwal.index') }}" class="nav-link">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>Jadwal Periksa</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('periksaDokter') }}" class="nav-link">
        <i class="nav-icon fas fa-search"></i>
        <p>Periksa</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('riwayatDokter') }}" class="nav-link">
        <i class="nav-icon fas fa-history"></i>
        <p>Riwayat Pasien</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('dokter.profile.edit') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Profil Saya</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </li>
  </ul>
</nav>
</div>
</aside>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard Dokter</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Box Jumlah Pasien -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $totalSelesai }}</h3>
              <p>Pasien Sudah Diperiksa</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-injured"></i>
            </div>
            <a href="{{ route('periksaDokter') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Box Jumlah Obat -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalBelum }}</h3>
              <p>Pasien Belum Diperiksa</p>
            </div>
            <div class="icon">
              <i class="fas fa-pills"></i>
            </div>
            <a href="{{ route('periksaDokter') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Box Jadwal Periksa -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>1</h3>
              <p>Jadwal Aktif</p>
            </div>
            <div class="icon">
              <i class="fas fa-calendar-check"></i>
            </div>
            <a href="{{ route('jadwal.index') }}" class="small-box-footer">Lihat Jadwal <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('layout.footer')