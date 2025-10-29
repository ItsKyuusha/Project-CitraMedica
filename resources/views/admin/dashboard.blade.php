@include('layout.header', ['title' => 'Dashboard Admin'])

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <!-- Dashboard -->
    <li class="nav-item menu-open">
      <a href="{{ route('admin.dashboard') }}" class="nav-link active">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>

    <!-- Kelola Dokter -->
    <li class="nav-item">
      <a href="{{ route('admin.dokter.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Kelola Dokter</p>
      </a>
    </li>

    <!-- Kelola Pasien -->
    <li class="nav-item">
      <a href="{{ route('admin.pasien.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Kelola Pasien</p>
      </a>
    </li>

    <!-- Kelola Poli -->
    <li class="nav-item">
      <a href="{{ route('admin.poli.index') }}" class="nav-link">
        <i class="nav-icon fas fa-hospital-symbol"></i>
        <p>Kelola Poli</p>
      </a>
    </li>

    <!-- Kelola Obat -->
    <li class="nav-item">
      <a href="{{ route('admin.obat.index') }}" class="nav-link">
        <i class="nav-icon fas fa-pills"></i>
        <p>Kelola Obat</p>
      </a>
    </li>

    <!-- Logout -->
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
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard Admin</h1>
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

  <!-- Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- Jumlah Dokter -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $jumlahDokter }}</h3>
              <p>Jumlah Dokter</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-md"></i>
            </div>
            <a href="{{ route('admin.dokter.index') }}" class="small-box-footer">
              Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Jumlah Pasien -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $jumlahPasien }}</h3>
              <p>Jumlah Pasien</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.pasien.index') }}" class="small-box-footer">
              Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Jumlah Poli -->
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background-color: #6f42c1; color: #fff;">
            <div class="inner">
              <h3>{{ $jumlahPoli }}</h3>
              <p>Jumlah Poli</p>
            </div>
            <div class="icon">
              <i class="fas fa-hospital-symbol"></i>
            </div>
            <a href="{{ route('admin.poli.index') }}" class="small-box-footer text-white">
              Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <!-- Jumlah Obat -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $jumlahObat }}</h3>
              <p>Jumlah Obat</p>
            </div>
            <div class="icon">
              <i class="fas fa-pills"></i>
            </div>
            <a href="{{ route('admin.obat.index') }}" class="small-box-footer">
              Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->

@include('layout.footer')
