{{-- resources/views/admin/dokter.blade.php --}}
@include('layout.header', ['title' => 'Kelola Dokter'])

<!-- Sidebar -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item menu-open">
            <a href="{{ route('admin.dokter.index') }}" class="nav-link active">
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
                    <h1 class="m-0">Kelola Dokter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Dokter</li>
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
                <!-- Form Tambah/Edit Dokter -->
                <div class="col-md-4">
                    <div class="card {{ isset($editMode) && $editMode ? 'card-warning' : 'card-primary' }}">
                        <div class="card-header">
                            <h3 class="card-title">{{ isset($editMode) && $editMode ? 'Edit Dokter' : 'Tambah Dokter' }}</h3>
                        </div>
                        <form action="{{ isset($editMode) && $editMode ? route('admin.dokter.update', $dokter->id) : route('admin.dokter.store') }}" method="POST">
                            @csrf
                            @if(isset($editMode) && $editMode)
                            @method('PUT')
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Dokter</label>
                                    <input type="text" name="nama" class="form-control" required value="{{ old('nama', $editMode ? $dokter->nama : '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required value="{{ old('email', $editMode ? $dokter->user->email : '') }}">
                                </div>
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control" required value="{{ old('no_hp', $editMode ? $dokter->user->no_hp : '') }}">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $editMode ? $dokter->user->alamat : '') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Password {{ $editMode ? '(Kosongkan jika tidak ingin mengubah)' : '' }}</label>
                                    <input type="password" name="password" class="form-control" {{ $editMode ? '' : 'required' }} placeholder="{{ $editMode ? 'Kosongkan jika tidak ingin mengubah' : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Pilih Poli</label>
                                    <select name="poli_id" class="form-control" required>
                                        <option value="" disabled {{ !$editMode ? 'selected' : '' }}>-- Pilih Poli --</option>
                                        @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ old('poli_id', $editMode ? $dokter->poli_id : '') == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn {{ $editMode ? 'btn-warning' : 'btn-primary' }} btn-block">
                                    {{ $editMode ? 'Update' : 'Simpan' }}
                                </button>
                                @if($editMode)
                                <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary btn-block mt-2">Batal Edit</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabel Dokter -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title">Daftar Dokter</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Poli</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dokters as $dokter)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dokter->nama }}</td>
                                        <td>{{ $dokter->poli->nama ?? '-' }}</td>
                                        <td>{{ $dokter->user->no_hp }}</td>
                                        <td>{{ $dokter->user->email }}</td>
                                        <td>
                                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus dokter ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data dokter.</td>
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