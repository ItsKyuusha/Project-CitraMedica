@include('layout.header', ['title' => 'Dashboard Periksa'])

<!-- Sidebar -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
    <li class="nav-item menu-open">
      <a href="{{ route('dashboardPasien') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('periksaPasien') }}" class="nav-link active">
        <i class="nav-icon fas fa-search"></i>
        <p>Periksa</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-lock"></i>
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
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="m-0">Daftar Poli</h1>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      </div>
      @endif

      <div class="row">
        <!-- Form Pendaftaran -->
        <div class="col-md-5">
          <div class="card border-primary">
            <div class="card-header bg-primary text-white">Daftar Poli</div>
            <div class="card-body">
              <form action="{{ route('storePeriksa') }}" method="POST">
                @csrf

                <div class="form-group">
                  <label>Nomor Rekam Medis</label>
                  <input type="text" class="form-control" value="{{ Auth::user()->pasien->no_rm ?? '-' }}" readonly>
                </div>

                <div class="form-group">
                  <label>Pilih Jadwal Dokter</label>
                  <select name="id_jadwal" class="form-control" required>
                    <option value="">-- Pilih Jadwal Dokter --</option>
                    @foreach ($jadwalDokters as $jadwal)
                    <option value="{{ $jadwal->id }}">
                      {{ $jadwal->dokter->user->nama ?? '-' }} - {{ $jadwal->dokter->poli->nama ?? '-' }}
                      ({{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                    </option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label>Keluhan</label>
                  <textarea name="keluhan" rows="3" class="form-control"></textarea>

                </div>

                <div class="form-group text-right">
                  <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Riwayat Pendaftaran -->
        <div class="col-md-7">
          <div class="card border-info">
            <div class="card-header bg-info text-white">Riwayat daftar poli</div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-bordered m-0 text-nowrap">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Poli</th>
                      <th>Dokter</th>
                      <th>Hari</th>
                      <th>Mulai</th>
                      <th>Selesai</th>
                      <th>Antrian</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($periksa as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->jadwal->dokter->poli->nama ?? '-' }}</td>
                      <td>{{ $item->jadwal->dokter->user->nama ?? '-' }}</td>
                      <td>{{ $item->jadwal->hari ?? '-' }}</td>
                      <td>{{ $item->jadwal->jam_mulai ?? '-' }}</td>
                      <td>{{ $item->jadwal->jam_selesai ?? '-' }}</td>
                      <td>{{ $item->nomor_antrian }}</td>
                      <td>
                        @if ($item->status == 'selesai')
                        <span class="badge badge-success">Selesai</span>
                        @else
                        <span class="badge badge-danger">Belum diperiksa</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('periksa.detail', $item->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

@include('layout.footer')