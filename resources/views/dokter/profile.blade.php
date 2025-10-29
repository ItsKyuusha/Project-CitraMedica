@include('layout.header', ['title' => 'Profil Saya'])

<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item ">
            <a href="{{ route('dashboardDokter') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item ">
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
        <li class="nav-item menu-open">
            <a href="{{ route('dokter.profile.edit') }}" class="nav-link active">
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
            <h1>Profil Saya</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('dokter.profile.update') }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $dokter->nama) }}" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $dokter->user->alamat) }}" required>
                </div>


                <div class="form-group">
                    <label>Password Baru (opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </section>
</div>

@include('layout.footer')