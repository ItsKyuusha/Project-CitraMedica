@include('layout.header', ['title' => 'Edit Jadwal Periksa'])

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
            <h1>Edit Jadwal Periksa</h1>
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

            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Jadwal</h3>
                        </div>
                        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Hari</label>
                                    <select name="hari" class="form-control" required>
                                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                        <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input type="time" name="jam_mulai" class="form-control" required value="{{ $jadwal->jam_mulai }}">
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input type="time" name="jam_selesai" class="form-control" required value="{{ $jadwal->jam_selesai }}">
                                </div>
                                <div class="form-group">
                                    <label>Status Jadwal</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1" {{ $jadwal->status == 1 ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $jadwal->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Hanya satu jadwal yang boleh aktif.
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning btn-block">Update</button>
                                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-block mt-2">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@include('layout.footer')