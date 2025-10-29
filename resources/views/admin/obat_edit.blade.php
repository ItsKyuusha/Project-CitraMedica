{{-- resources/views/admin/obat_edit.blade.php --}}
@include('layout.header', ['title' => 'Edit Obat'])

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
          <h1 class="m-0">Edit Obat</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Kelola Obat</li>
            <li class="breadcrumb-item active">Edit Obat</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Form Edit Obat</h3>
        </div>
        <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST">
          @csrf @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label>Nama Obat</label>
              <input type="text" name="nama_obat" value="{{ old('nama_obat', $obat->nama_obat) }}" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kemasan</label>
              <input type="text" name="kemasan" value="{{ old('kemasan', $obat->kemasan) }}" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Harga</label>
              <input type="number" name="harga" value="{{ old('harga', $obat->harga) }}" class="form-control" required>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-warning">Update</button>
            <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary float-right">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

@include('layout.footer')