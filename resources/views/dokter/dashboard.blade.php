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
        <!-- Box Jumlah Pasien Sudah Diperiksa -->
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

        <!-- Box Jumlah Pasien Belum Diperiksa -->
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

        <!-- Box Total Pemeriksaan -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalPemeriksaan }}</h3>
              <p>Total Pemeriksaan</p>
            </div>
            <div class="icon">
              <i class="fas fa-stethoscope"></i>
            </div>
            <a href="{{ route('periksaDokter') }}" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Box Jadwal Aktif -->
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
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

      <!-- Row 2: Chart, 2 charts per row -->
      <div class="row">
        <!-- Chart 1: Pasien Sudah Diperiksa -->
        <div class="col-lg-6 col-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h4>Jumlah Pasien Sudah Diperiksa</h4>
            </div>
            <div class="card-body">
              <canvas id="dokterChart1" height="150"></canvas>
            </div>
          </div>
        </div>

        <!-- Chart 2: Pasien Belum Diperiksa -->
        <div class="col-lg-6 col-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h4>Jumlah Pasien Belum Diperiksa</h4>
            </div>
            <div class="card-body">
              <canvas id="dokterChart2" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Chart 3: Total Pemeriksaan -->
        <div class="col-lg-6 col-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h4>Total Pemeriksaan</h4>
            </div>
            <div class="card-body">
              <canvas id="dokterChart3" height="150"></canvas>
            </div>
          </div>
        </div>

        <!-- Chart 4: Data Pemeriksaan lainnya (misalnya Pasien per Tahun) -->
        <div class="col-lg-6 col-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h4>Jumlah Pasien</h4>
            </div>
            <div class="card-body">
              <canvas id="dokterChart4" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
<!-- /.content-wrapper -->
@include('layout.footer')
<script>
  // Chart Pasien Sudah Diperiksa
  var ctx1 = document.getElementById('dokterChart1').getContext('2d');
  var dokterChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: @json($dokterData->pluck('month')),  // Bulan
      datasets: [{
        label: 'Jumlah Pasien Sudah Diperiksa',
        data: @json($dokterData->pluck('count')),  // Jumlah pasien
        backgroundColor: 'rgba(75, 192, 192, 0.5)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Chart Pasien Belum Diperiksa
  var ctx2 = document.getElementById('dokterChart2').getContext('2d');
  var dokterChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: @json($dokterData->pluck('month')),
      datasets: [{
        label: 'Jumlah Pasien Belum Diperiksa',
        data: @json($dokterData->pluck('count')),
        backgroundColor: 'rgba(153, 102, 255, 0.5)',
        borderColor: 'rgba(153, 102, 255, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Total Pemeriksaan Chart
  var ctx3 = document.getElementById('dokterChart3').getContext('2d');
  var dokterChart3 = new Chart(ctx3, {
    type: 'line',
    data: {
      labels: @json($dokterData->pluck('month')),
      datasets: [{
        label: 'Total Pemeriksaan',
        data: @json($dokterData->pluck('count')),
        fill: false,
        borderColor: 'rgba(255, 99, 132, 1)',
        tension: 0.1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  // Chart Pasien per Tahun
  var ctx4 = document.getElementById('dokterChart4').getContext('2d');
  var dokterChart4 = new Chart(ctx4, {
    type: 'line',
    data: {
      labels: @json($dokterData->pluck('year')),
      datasets: [{
        label: 'Jumlah Pasien per Tahun',
        data: @json($dokterData->pluck('count')),
        fill: false,
        borderColor: 'rgba(255, 159, 64, 1)',
        tension: 0.1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>