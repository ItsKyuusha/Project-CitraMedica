{{-- resources/views/admin/obat.blade.php --}}
@include('layout.header', ['title' => 'Kelola Obat'])

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
    <li class="nav-item">
      <a href="{{ route('admin.pasien.index') }}" class="nav-link">
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
    <li class="nav-item menu-open">
      <a href="{{ route('admin.obat.index') }}" class="nav-link active">
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
          <h1 class="m-0">Kelola Obat</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Kelola Obat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>


  <section class="content">
    <div class="container-fluid">

      {{-- Notifikasi --}}
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

      <div class="row">
        <!-- Form Tambah Obat -->
        <div class="col-md-4">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Tambah Obat</h3>
            </div>
            <form action="{{ route('admin.obat.store') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Obat</label>
                  <input type="text" name="nama_obat" class="form-control" required value="{{ old('nama_obat') }}">
                </div>
                <div class="form-group">
                  <label>Kemasan</label>
                  <input type="text" name="kemasan" class="form-control" required value="{{ old('kemasan') }}">
                </div>
                <div class="form-group">
                  <label>Harga</label>
                  <input type="number" name="harga" class="form-control" required value="{{ old('harga') }}">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Tabel Obat -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-success">
              <h3 class="card-title">Daftar Obat</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($obats as $obat)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kemasan }}</td>
                    <td>Rp{{ number_format($obat->harga, 0, ',', '.') }}</td>
                    <td>
                      <a href="{{ route('admin.obat.edit', $obat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('admin.obat.destroy', $obat->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">Belum ada data obat.</td>
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