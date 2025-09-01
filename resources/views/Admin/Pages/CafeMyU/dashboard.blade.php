@extends('Admin.Layouts.main')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">
    {{-- Welcome Card --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="fw-bold">Selamat Datang, {{ auth()->user()->name }} 🎉</h4>
                    <p class="mb-0 text-muted">Ini adalah halaman dashboard Anda. Gunakan menu di sidebar untuk navigasi lebih lanjut.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Total Pengguna</h5>
                    <h3 class="text-primary">125</h3>
                    <small class="text-muted">aktif bulan ini</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Transaksi</h5>
                    <h3 class="text-success">Rp 8.250.000</h3>
                    <small class="text-muted">bulan ini</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold">Laporan</h5>
                    <h3 class="text-warning">32</h3>
                    <small class="text-muted">butuh ditinjau</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">Data Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ahmad Hasan</td>
                                    <td>hasan@example.com</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td>01 Sep 2025</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Rina Kartika</td>
                                    <td>rina@example.com</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>30 Agu 2025</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Budi Santoso</td>
                                    <td>budi@example.com</td>
                                    <td><span class="badge bg-danger">Nonaktif</span></td>
                                    <td>29 Agu 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

