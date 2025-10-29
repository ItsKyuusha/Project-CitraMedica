@include('layout.header', ['title' => 'Riwayat Pasien'])

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
        <li class="nav-item">
            <a href="{{ route('periksaDokter') }}" class="nav-link">
                <i class="nav-icon fas fa-search"></i>
                <p>Periksa</p>
            </a>
        </li>
        <li class="nav-item menu-open">
            <a href="{{ route('riwayatDokter') }}" class="nav-link active">
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

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Riwayat Pasien</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Daftar Riwayat Pasien</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>No. KTP</th>
                                <th>No. Telepon</th>
                                <th>No. RM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat->groupBy('pasien.id') as $index => $grouped)
                            @php $pasien = $grouped->first()->pasien; @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pasien->nama }}</td>
                                <td>{{ $pasien->pasien->alamat ?? '-' }}</td>
                                <td>{{ $pasien->pasien->no_ktp ?? '-' }}</td>
                                <td>{{ $pasien->pasien->no_hp ?? '-' }}</td>
                                <td>{{ $pasien->pasien->no_rm ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('dokter.riwayat.detail', $pasien->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Detail Riwayat Periksa
                                    </a>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data riwayat pasien</td>
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