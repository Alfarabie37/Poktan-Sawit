@extends('layouts.app')

@section('title', 'Dashboard - Poktan-Sawit')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Kelompok Tani Sawit</h1>
    <a href="{{ route('petani.create') }}" class="btn btn-sm btn-success shadow-sm">
        <i class="fas fa-user-plus fa-sm text-white-50"></i> Tambah Anggota Baru
    </a>
</div>

<!-- Content Row: Kartu Statistik -->
<div class="row">

    <!-- Card 1: Total Anggota Petani -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Anggota Petani</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPetani }} Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Luas Lahan Sawit -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Luas Kebun Sawit</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalLuasLahan, 2) }} Ha</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-map-marked-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Rata-rata Kepemilikan Lahan -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Rata-Rata Lahan / Petani</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($rataRataLahan, 2) }} Ha</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row: Tabel Ringkasan Anggota Terbaru -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">Anggota Petani Terbaru</h6>
                <a href="{{ route('petani.index') }}" class="btn btn-sm btn-outline-success">Lihat Semua</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Petani</th>
                                <th>Alamat</th>
                                <th>Luas Lahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($petaniTerbaru as $index => $petani)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $petani->nik }}</td>
                                <td>{{ $petani->nama_petani }}</td>
                                <td>{{ $petani->alamat }}</td>
                                <td>{{ number_format($petani->luas_lahan, 2) }} Ha</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data petani terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection