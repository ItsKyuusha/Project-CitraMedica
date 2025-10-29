@include('layout.header', ['title' => 'Jadwal Dokter'])

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item ">
            <a href="{{ route('dashboardDokter') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item menu-open">
            <a href="{{ route('jadwal.index') }}" class="nav-link active">
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

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Jadwal Periksa</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <!-- Form Tambah Jadwal -->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Jadwal</h3>
                        </div>
                        <form action="{{ route('jadwal.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Hari</label>
                                    <select name="hari" class="form-control" required>
                                        <option value="" disabled selected>Pilih hari</option>
                                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                        <option value="{{ $hari }}">{{ $hari }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Jadwal -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title">Daftar Jadwal</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam Mulai</th>
                                        <th>Jam Selesai</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->hari }}</td>
                                        <td>{{ $jadwal->jam_mulai }}</td>
                                        <td>{{ $jadwal->jam_selesai }}</td>
                                        <td>
                                            @if($jadwal->is_aktif)
                                            <span class="badge badge-success">Aktif</span>
                                            @else
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(\Carbon\Carbon::now()->format('l') != $jadwal->hari)
                                            <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @else
                                            <span class="text-muted">Tidak bisa edit hari ini</span>
                                            @endif
                                            @if(!$jadwal->is_aktif)
                                            <form action="{{ route('jadwal.aktifkan', $jadwal->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" onclick="return confirm('Aktifkan jadwal ini?')">Aktifkan</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada jadwal.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@include('layout.footer')