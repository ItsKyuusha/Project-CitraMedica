@include('layout.header', ['title' => 'Periksa Pasien'])

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
    <li class="nav-item menu-open">
      <a href="{{ route('periksaDokter') }}" class="nav-link active">
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

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Pemeriksaan Pasien</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('info'))
      <div class="alert alert-warning">{{ session('info') }}</div>
      @endif

      <div class="row">
        @if($antrianSekarang)
        <!-- Card Informasi Jadwal -->
        <div class="col-md-8 col-sm-6 mb-4">
          <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
              <h5 class="card-title text-center">Informasi Jadwal</h5>
            </div>
            <div class="card-body">
              <p><strong>Poli:</strong> {{ optional($antrianSekarang->jadwal->dokter->poli)->nama ?? 'Tidak Tersedia' }}</p>
              <p><strong>Dokter:</strong> {{ optional($antrianSekarang->jadwal->dokter)->nama ?? 'Tidak Tersedia' }}</p>
              <p><strong>Jam Periksa:</strong> {{ $antrianSekarang->jadwal->jam_mulai ?? 'Tidak Tersedia' }}</p>
              <p><strong>Tanggal Periksa:</strong> {{ $antrianSekarang->jadwal->updated_at->format('d-m-Y') ?? 'Tidak Tersedia' }}</p>
            </div>
          </div>
        </div>

        <!-- Card Antrian Pasien -->
        <div class="col-md-4 col-sm-6 mb-4">
          <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
              <h5 class="card-title text-center">Antrian Saat Ini</h5>
            </div>
            <div class="card-body text-center">
              <h1 class="font-weight-bold text-center">No: {{ $antrianSekarang->nomor_antrian }}</h1>
              <h4 class="card-text text-muted">{{ $antrianSekarang->pasien->nama }}</h4>
              <p class="card-text text-muted">No: RM{{ $antrianSekarang->pasien->pasien->no_rm ?? "-"}}</p>
              <div class="mt-3">
                <span class="badge badge-warning">Belum Diperiksa</span>
                <form action="{{ route('periksa.next') }}" method="POST" onsubmit="return confirm('Lewati pasien ini dan lanjut ke berikutnya?');">
                  @csrf
                  <button type="submit" class="btn btn-danger btn-sm mt-2">
                    <i class="fas fa-forward"></i> Next Antrian
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-12">
          <div class="alert alert-info text-center">
            Tidak ada pasien dalam antrian saat ini.
          </div>
        </div>
        @endif
      </div>


      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Pasien</h3>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered">
            <thead class="bg-primary text-white">
              <tr>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Keluhan</th>
                <th>Status Pemeriksaan</th> <!-- Kolom baru untuk status -->
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($periksa as $item)
              <tr>

                <td>{{ $item->pasien->pasien->no_rm ?? '-' }}</td>

                <td>{{ $item->pasien->nama }}</td>
                <td>{{ $item->keluhan ?? '-' }}</td>

                <!-- Kolom Status Pemeriksaan -->
                <td>
                  @if($item->status === 'selesai')
                  <span class="badge badge-success">Selesai Diperiksa</span>
                  @else
                  <span class="badge badge-warning">Belum Diperiksa</span>
                  @endif
                </td>

                <!-- Kolom Aksi -->
                <td>
                  <button class="btn btn-sm {{ $item->status === 'selesai' ? 'btn-warning' : 'btn-primary' }} "
                    data-toggle="modal"
                    data-target="#editModal"
                    data-id="{{ $item->id }}"
                    data-nama="{{ $item->pasien->nama }}"
                    data-tgl="{{ $item->tgl_periksa }}"
                    data-keluhan="{{ $item->keluhan }}"
                    data-catatan="{{ $item->catatan_dokter }}"
                    data-biaya="{{ $item->biaya_periksa }}">
                    <i class="fas fa-{{ $item->status === 'selesai' ? 'edit' : 'stethoscope' }}"></i>
                    {{ $item->status === 'selesai' ? 'Edit' : 'Periksa' }}
                  </button>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">Belum ada pasien</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Pemeriksaan -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="" id="formEditPeriksa">@csrf @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Pemeriksaan</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Pasien</label>
            <input type="text" id="nama" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Tanggal Periksa</label>
            <input type="text" id="tgl_periksa" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Keluhan</label>
            <textarea id="keluhan" class="form-control" rows="2" readonly></textarea>
          </div>
          <div class="form-group">
            <label>Catatan Dokter</label>
            <textarea name="catatan_dokter" id="catatan_dokter" class="form-control" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label>Pilih Obat</label>
            <select id="obat" class="form-control">
              <option value="">-- Pilih Obat --</option>
              @foreach ($obats as $obat)
              <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-harga="{{ $obat->harga }}">
                {{ $obat->nama_obat }} - Rp. {{ number_format($obat->harga) }}
              </option>
              @endforeach
            </select>
          </div>
          <ul class="list-group mb-3" id="listObat"></ul>
          <div class="form-group">
            <label>Total Biaya</label>
            <input type="text" id="biaya_periksa_view" class="form-control" readonly>
            <input type="hidden" name="biaya_periksa" id="biaya_periksa">
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

<!-- Script Modal -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let hargaPemeriksaan = 150000;
    let totalObat = 0;

    function updateTotal() {
      const total = hargaPemeriksaan + totalObat;
      $('#biaya_periksa').val(total);
      $('#biaya_periksa_view').val('Rp. ' + total.toLocaleString('id-ID'));
    }

    $('#editModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      const modal = $(this);

      modal.find('#nama').val(button.data('nama'));
      modal.find('#tgl_periksa').val(button.data('tgl'));
      modal.find('#keluhan').val(button.data('keluhan'));
      modal.find('#catatan_dokter').val(button.data('catatan'));
      modal.find('#biaya_periksa_view').val('Rp. ' + parseInt(button.data('biaya')).toLocaleString('id-ID'));
      modal.find('#biaya_periksa').val(button.data('biaya'));

      $('#listObat').empty();
      totalObat = 0;
      updateTotal();

      modal.find('#formEditPeriksa').attr('action', '/dokter/periksa/' + button.data('id'));
    });

    $('#obat').on('change', function() {
      const selected = $('#obat option:selected');
      const id = selected.val();
      const nama = selected.data('nama');
      const harga = selected.data('harga');

      if (id && !$('#obat-item-' + id).length) {
        const html = ` 
          <li class="list-group-item d-flex justify-content-between align-items-center" id="obat-item-${id}">
            ${nama} - Rp. ${harga.toLocaleString('id-ID')}
            <input type="hidden" name="obats[]" value="${id}">
            <button type="button" class="btn btn-danger btn-sm btnHapusObat" data-id="${id}" data-harga="${harga}">Hapus</button>
          </li>`;
        $('#listObat').append(html);
        totalObat += parseInt(harga);
        updateTotal();
      }
    });

    $(document).on('click', '.btnHapusObat', function() {
      const id = $(this).data('id');
      const harga = $(this).data('harga');
      $('#obat-item-' + id).remove();
      totalObat -= parseInt(harga);
      updateTotal();
    });
  });
</script>

@include('layout.footer')