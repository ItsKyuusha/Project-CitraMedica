@include('layout.header', ['title' => 'Detail Riwayat Pemeriksaan'])

<!-- Sidebar -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <li class="nav-item">
            <a href="{{ route('dashboardDokter') }}" class="nav-link">
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
        <li class="nav-item menu-open">
            <a href="{{ route('periksaDokter') }}" class="nav-link active">
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
</aside>('layout.sidebar')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Riwayat {{ $namaPasien }}</h1>
            <p class="mt-1 text-muted">
                Total kunjungan: <strong>{{ $totalKunjungan }}</strong> kali
            </p>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Detail Riwayat Pemeriksaan</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover table-striped text-nowrap">
                        <thead class="bg-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Periksa</th>
                                <th>Nama Pasien</th>
                                <th>Nama Dokter</th>
                                <th>Keluhan</th>
                                <th>Catatan</th>
                                <th>Obat</th>
                                <th>Biaya Periksa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayat as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tgl_periksa)->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $item->pasien->nama }}</td>
                                <td>{{ $item->jadwal->dokter->user->nama ?? '-' }}</td>
                                <td>{{ $item->keluhan }}</td>
                                <td>{{ $item->catatan_dokter ?? '-' }}</td>
                                <td>
                                    @if ($item->obats->isEmpty())
                                    <span class="text-muted">Tidak ada</span>
                                    @else
                                    <ul class="pl-3 mb-0">
                                        @foreach ($item->obats as $obat)
                                        <li>{{ $obat->nama_obat }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </td>
                                <td>Rp{{ number_format($item->biaya_periksa, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    Belum ada riwayat pemeriksaan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

@include('layout.footer')