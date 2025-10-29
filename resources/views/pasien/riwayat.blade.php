@extends('layout')

@section('sidebar')
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.periksa') }}" class="nav-link">
                    <p>
                        Periksa
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.riwayat') }}" class="nav-link active">
                    <p>
                        Riwayat
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Periksa</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

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
                                    <th>No</th>
                                    <th>Dokter</th>
                                    <th>Tanggal Periksa</th>
                                    <th>Biaya Periksa</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>dr. Andi</td>
                                    <td>10-04-2025</td>
                                    <td><span class="badge badge-success">Rp 150.000</span></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modalDetail1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>dr. Budi</td>
                                    <td>11-04-2025</td>
                                    <td><span class="badge badge-danger">Belum Ada</span></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modalDetail2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <!-- Modal Detail 1 -->
                    <div class="modal fade" id="modalDetail1" tabindex="-1" role="dialog" aria-labelledby="modalLabel1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Pemeriksaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Dokter:</strong> dr. Andi</p>
                                    <p><strong>Tanggal Periksa:</strong> 10-04-2025 10:00</p>
                                    <p><strong>Biaya:</strong> Rp 150.000</p>
                                    <p><strong>Catatan:</strong> Pasien mengalami flu ringan</p>
                                    <p><strong>Obat:</strong></p>
                                    <ul>
                                        <li>Paracetamol | Tablet 500mg</li>
                                        <li>Vitamin C | Tablet 100mg</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail 2 -->
                    <div class="modal fade" id="modalDetail2" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Pemeriksaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Dokter:</strong> dr. Budi</p>
                                    <p><strong>Tanggal Periksa:</strong> 11-04-2025 14:30</p>
                                    <p><strong>Biaya:</strong> <span class="text-danger">Belum Diinput</span></p>
                                    <p><strong>Catatan:</strong> <span class="text-danger">Belum Ada Catatan</span></p>
                                    <p><strong>Obat:</strong></p>
                                    <ul>
                                        <li>-</li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    {{-- {{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d-m-Y') }} --}}
    <!-- /.content -->
@endsection
