@include('layout.header', ['title' => 'Dashboard Admin'])
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        <!-- Row 1: Card-statistics, 4 cards in one row -->
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

      <!-- Row 2: Chart, 2 charts per row -->
      <div class="row">
          <!-- Dokter Chart -->
          <div class="col-lg-6 col-12 mb-4">
              <div class="card">
                  <div class="card-header">
                      <h4>Jumlah Dokter per Tahun</h4> <!-- Chart Title -->
                  </div>
                  <div class="card-body">
                      <canvas id="dokterChart" height="150"></canvas>
                  </div>
              </div>
          </div>

          <!-- Pasien Chart -->
          <div class="col-lg-6 col-12 mb-4">
              <div class="card">
                  <div class="card-header">
                      <h4>Jumlah Pasien per Tahun</h4> <!-- Chart Title -->
                  </div>
                  <div class="card-body">
                      <canvas id="pasienChart" height="150"></canvas>
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <!-- Poli Chart -->
          <div class="col-lg-6 col-12 mb-4">
              <div class="card">
                  <div class="card-header">
                      <h4>Jumlah Poli per Tahun</h4> <!-- Chart Title -->
                  </div>
                  <div class="card-body">
                      <canvas id="poliChart" height="150"></canvas>
                  </div>
              </div>
          </div>

          <!-- Obat Chart -->
          <div class="col-lg-6 col-12 mb-4">
              <div class="card">
                  <div class="card-header">
                      <h4>Jumlah Obat per Tahun</h4> <!-- Chart Title -->
                  </div>
                  <div class="card-body">
                      <canvas id="obatChart" height="150"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </section>
</div>
<!-- /.content-wrapper -->

@include('layout.footer')
<script>
  // Dokter Chart
  var ctxDokter = document.getElementById('dokterChart').getContext('2d');
  var dokterChart = new Chart(ctxDokter, {
    type: 'bar',
    data: {
      labels: @json($dokterData->pluck('year')),  // Pastikan ini benar
      datasets: [{
        label: 'Jumlah Dokter per Tahun',
        data: @json($dokterData->pluck('count')),  // Pastikan data jumlah dokter diteruskan dengan benar
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

  // Pasien Chart
  var ctxPasien = document.getElementById('pasienChart').getContext('2d');
  var pasienChart = new Chart(ctxPasien, {
    type: 'line',
    data: {
      labels: @json($pasienData->pluck('year')),  // Pastikan ini benar
      datasets: [{
        label: 'Jumlah Pasien per Tahun',
        data: @json($pasienData->pluck('count')),  // Pastikan data jumlah pasien diteruskan dengan benar
        borderColor: 'rgba(54, 162, 235, 1)',
        fill: false,
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

  // Poli Chart
  var ctxPoli = document.getElementById('poliChart').getContext('2d');
  var poliChart = new Chart(ctxPoli, {
    type: 'bar',
    data: {
      labels: @json($poliData->pluck('year')),  // Pastikan ini benar
      datasets: [{
        label: 'Jumlah Poli per Tahun',
        data: @json($poliData->pluck('count')),  // Pastikan data jumlah poli diteruskan dengan benar
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

  // Obat Chart
  var ctxObat = document.getElementById('obatChart').getContext('2d');
  var obatChart = new Chart(ctxObat, {
    type: 'line',
    data: {
      labels: @json($obatData->pluck('year')),  // Pastikan ini benar
      datasets: [{
        label: 'Jumlah Obat per Tahun',
        data: @json($obatData->pluck('count')),  // Pastikan data jumlah obat diteruskan dengan benar
        borderColor: 'rgba(255, 99, 132, 1)',
        fill: false,
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