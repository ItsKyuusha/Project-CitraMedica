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

<!-- Content -->
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="m-0">Detail Pemeriksaan</h1>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-4">Poli</dt>
            <dd class="col-sm-8">{{ $periksa->jadwal->dokter->poli->nama ?? '-' }}</dd>

            <dt class="col-sm-4">Dokter</dt>
            <dd class="col-sm-8">{{ $periksa->jadwal->dokter->user->nama ?? '-' }}</dd>

            <dt class="col-sm-4">Hari</dt>
            <dd class="col-sm-8">{{ $periksa->jadwal->hari ?? '-' }}</dd>

            <dt class="col-sm-4">Jam Mulai</dt>
            <dd class="col-sm-8">{{ $periksa->jadwal->jam_mulai ?? '-' }}</dd>

            <dt class="col-sm-4">Jam Selesai</dt>
            <dd class="col-sm-8">{{ $periksa->jadwal->jam_selesai ?? '-' }}</dd>

            <dt class="col-sm-4">Nomor Antrian</dt>
            <dd class="col-sm-8">
              <span class="badge badge-success" style="font-size: 1.2rem;">{{ $periksa->nomor_antrian }}</span>
            </dd>

            <dt class="col-sm-4">Keluhan</dt>
            <dd class="col-sm-8">{{ $periksa->keluhan ?? '-' }}</dd>

            <dt class="col-sm-4">Catatan Dokter</dt>
            <dd class="col-sm-8">
              @if($periksa->status === 'selesai')
                {{ $periksa->catatan_dokter ?? '-' }}
              @else
                <span class="text-muted">Belum diperiksa</span>
              @endif
            </dd>

            <dt class="col-sm-4">Obat</dt>
            <dd class="col-sm-8">
              @if($periksa->status === 'selesai' && $periksa->obats->count())
                <ul>
                  @foreach($periksa->obats as $obat)
                    <li>{{ $obat->nama_obat }} - {{ $obat->kemasan }} (Rp. {{ number_format($obat->harga, 0, ',', '.') }})</li>
                  @endforeach
                </ul>
              @else
                <span class="text-muted">-</span>
              @endif
            </dd>

            <dt class="col-sm-4">Biaya Pemeriksaan</dt>
            <dd class="col-sm-8">
              @if($periksa->status === 'selesai')
                Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}
              @else
                <span class="text-muted">Belum dihitung</span>
              @endif
            </dd>
          </dl>

          <a href="{{ route('periksaPasien') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </div>
  </section>
</div>

@include('layout.footer')
