@extends('layouts.app')

@section('title', 'Dashboard Kelompok Tani - PoktanSawit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="font-weight-bold text-dark mb-1">Dashboard {{ $poktan->nama_kelompok ?? 'Kelompok Tani' }}</h4>
        <p class="text-muted small mb-0">Ringkasan anggota petani, luas lahan sawit, hasil panen TBS, dan distribusi pupuk</p>
    </div>
    <a href="{{ route('petani.create') }}" class="btn btn-poktan">
        <i class="fas fa-user-plus mr-1"></i> Tambah Petani
    </a>
</div>

<!-- 4 Kartu Statistik Pengurus -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL ANGGOTA PETANI</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ $totalPetani }} Orang</div>
            <small class="text-success"><i class="fas fa-users mr-1"></i> Anggota terdaftar</small>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL LUAS KEBUN</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ number_format($totalLuasLahan, 2) }} Ha</div>
            <small class="text-muted">{{ $totalLahan }} persil lahan sawit</small>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL HASIL PANEN (TBS)</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ number_format($totalPanenKg, 0, ',', '.') }} Kg</div>
            <small class="text-success"><i class="fas fa-balance-scale mr-1"></i> Akumulasi produksi</small>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">DISTRIBUSI PUPUK</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ number_format($totalPupukKg, 0, ',', '.') }} Kg</div>
            <small class="text-warning"><i class="fas fa-boxes mr-1"></i> Tersalurkan ke anggota</small>
        </div>
    </div>
</div>

<!-- Tabel Anggota Petani Terbaru -->
<div class="card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="font-weight-bold text-dark mb-0">Anggota Petani Terbaru</h6>
        <a href="{{ route('petani.index') }}" class="btn btn-sm btn-outline-success" style="border-radius: 8px;">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background: #F8FAFC;">
                <tr>
                    <th class="border-0 text-muted small">NO</th>
                    <th class="border-0 text-muted small">NIK</th>
                    <th class="border-0 text-muted small">NAMA PETANI</th>
                    <th class="border-0 text-muted small">JABATAN</th>
                    <th class="border-0 text-muted small">NO. HP</th>
                    <th class="border-0 text-muted small">TOTAL LAHAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petaniTerbaru as $index => $petani)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-muted">{{ $petani->nik }}</td>
                    <td class="font-weight-bold text-dark">{{ $petani->nama_petani }}</td>
                    <td><span class="badge badge-light border">{{ ucfirst($petani->jabatan ?? 'Anggota') }}</span></td>
                    <td>{{ $petani->no_hp ?? '-' }}</td>
                    <td>{{ number_format($petani->lahans->sum('luas_hektar'), 2) }} Ha</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data anggota petani di kelompok ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
