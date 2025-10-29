
{{-- resources/views/admin/poli.blade.php --}}
@include('layout.header', ['title' => 'Kelola Poli'])

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
    <li class="nav-item menu-open">
      <a href="{{ route('admin.poli.index') }}" class="nav-link active">
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
                    <h1 class="m-0">Kelola Poli</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Poli</li>
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
        <!-- Form Tambah/Edit Poli -->
        <div class="col-md-4">
          <div class="card {{ isset($editMode) ? 'card-warning' : 'card-primary' }}">
            <div class="card-header">
              <h3 class="card-title">{{ isset($editMode) ? 'Edit Poli' : 'Tambah Poli' }}</h3>
            </div>
            <form action="{{ isset($editMode) ? route('admin.poli.update', $poli->id) : route('admin.poli.store') }}" method="POST">
              @csrf
              @if(isset($editMode))
                @method('PUT')
              @endif
              <div class="card-body">
                <div class="form-group">
                  <label>Nama Poli</label>
                  <input type="text" name="nama" class="form-control" required
                    value="{{ old('nama', isset($editMode) ? $poli->nama : '') }}">
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea name="keterangan" class="form-control">{{ old('keterangan', isset($editMode) ? $poli->keterangan : '') }}</textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn {{ isset($editMode) ? 'btn-warning' : 'btn-primary' }} btn-block">
                  {{ isset($editMode) ? 'Update' : 'Simpan' }}
                </button>
                @if(isset($editMode))
                <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary btn-block mt-2">Batal Edit</a>
                @endif
              </div>
            </form>
          </div>
        </div>

        <!-- Tabel Daftar Poli -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-success">
              <h3 class="card-title">Daftar Poli</h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Poli</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($polis as $poli)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $poli->nama }}</td>
                    <td>{{ $poli->keterangan ?? '-' }}</td>
                    <td>
                      <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus poli ini?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="4" class="text-center">Belum ada data poli.</td>
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
