@include('layout.header', ['title' => 'Dashboard Obat'])
<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item menu-open">
      <a href="{{ route('dashboardDokter') }}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('periksaDokter') }}" class="nav-link">
        <i class="nav-icon fas fa-search"></i>
        <p>
          Periksa
          
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('obatDokter') }}" class="nav-link active">
        <i class="nav-icon fas fa-vials"></i>
        <p>
          Obat
          
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon fas fa-lock"></i>
        <p>Logout</p>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <!-- <h1 class="m-0">Dashboard</h1> -->
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Obat</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Obat</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="obat">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="nama_obat">Nama Obat</label>
              <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Enter nama obat">
            </div>
            <div class="form-group">
              <label for="kemasan">Jenis Kemasan</label>
              <input type="text" class="form-control" id="kemasan" name="kemasan" placeholder="Enter jenis kemasan">
            </div>
            <div class="form-group">
              <label for="harga">Harga Obat</label>
              <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter harga obat">
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tambah Obat</button>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Daftar Obat</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Harga</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($obats as $obat)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->kemasan }}</td>
                    <td>Rp. {{ number_format($obat->harga, 0, ',','.') }}</td>
                    <td>
                      <button
                        class="btn btn-warning"
                        data-toggle="modal"
                        data-target="#editModal"
                        data-id="{{ $obat->id }}"
                        data-nama="{{ $obat->nama_obat }}"
                        data-kemasan="{{ $obat->kemasan }}"
                        data-harga="{{ $obat->harga }}">
                        Edit
                      </button>

                      <button
                        class="btn btn-danger btn-delete"
                        data-id="{{ $obat->id }}"
                        data-nama="{{ $obat->nama_obat }}">
                        Delete
                      </button>

                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- Modal Edit Obat -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="" id="formEditObat">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Obat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" id="nama" name="nama_obat" class="form-control">
          </div>
          <div class="form-group">
            <label>Kemasan</label>
            <input type="text" name="kemasan" id="kemasan" class="form-control"></input>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" id="harga" name="harga" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('#editModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      const id = button.data('id');
      const nama = button.data('nama');
      const kemasan = button.data('kemasan');
      const harga = button.data('harga');

      const modal = $(this);
      modal.find('#nama').val(nama);
      modal.find('#kemasan').val(kemasan);
      modal.find('#harga').val(harga);

      // Update action URL
      const actionUrl = '/dokter/obat/' + id;
      modal.find('#formEditObat').attr('action', actionUrl);
    });
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    $(document).on('click', '.btn-delete', function () {
      const id = $(this).data('id');

      const form = $('<form>', {
        method: 'POST',
        action: `/dokter/obat/${id}`
      });

      form.append('<input type="hidden" name="_token" value="{{ csrf_token() }}">');
      form.append('<input type="hidden" name="_method" value="DELETE">');

      $('body').append(form);
      form.submit();
    });
  });
</script>

<!-- /.content-wrapper -->
@include ('layout.footer')