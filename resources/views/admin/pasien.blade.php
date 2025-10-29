{{-- resources/views/admin/pasien.blade.php --}}
@include('layout.header', ['title' => 'Kelola Pasien'])

<!-- Sidebar -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
    <li class="nav-item">
      <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.dokter.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Kelola Dokter</p>
      </a>
    </li>
    <li class="nav-item menu-open">
      <a href="{{ route('admin.pasien.index') }}" class="nav-link active">
        <i class="nav-icon fas fa-users"></i>
        <p>Kelola Pasien</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.poli.index') }}" class="nav-link">
        <i class="nav-icon fas fa-hospital-symbol"></i>
        <p>Kelola Poli</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.obat.index') }}" class="nav-link">
        <i class="nav-icon fas fa-capsules"></i>
        <p>Kelola Obat</p>
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
  <!-- Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2 align-items-center">
        <div class="col-sm-6">
          <h1 class="m-0">Kelola Pasien</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kelola Pasien</li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <section class="content">
    <div class="container-fluid">
      @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="row">
        <!-- Form Tambah Pasien -->
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tambah Pasien</h3>
            </div>
            <form action="{{ route('admin.pasien.store') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>No KTP</label>
                  <input type="text" name="no_ktp" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>No HP</label>
                  <input type="text" name="no_hp" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Tabel Pasien -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-success">
              <h3 class="card-title">Daftar Pasien</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No RM</th>
                    <th>Nama</th>
                    <th>No KTP</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($pasiens as $pasien)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->no_ktp }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>
                      <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pasien ini?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center">Belum ada data pasien.</td>
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