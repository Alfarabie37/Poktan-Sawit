@extends('layouts.app')

@section('title', 'Dashboard Super Admin - PoktanSawit')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="font-weight-bold text-dark mb-1">Dashboard Nasional Super Admin</h4>
        <p class="text-muted small mb-0">Pemantauan seluruh kelompok tani sawit, verifikasi pendaftaran, dan agregat produksi</p>
    </div>
    <a href="{{ route('admin.verifikasi') }}" class="btn btn-poktan">
        <i class="fas fa-check-circle mr-1"></i> Verifikasi Poktan ({{ $menungguVerifikasi }})
    </a>
</div>

<!-- 4 Kartu Statistik Nasional -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL KELOMPOK TANI</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ $totalPoktan }} Poktan</div>
            <small class="text-success">{{ $poktanAktif }} aktif • {{ $menungguVerifikasi }} menunggu</small>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL PETANI TERDAFTAR</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ $totalPetaniNasional }} Orang</div>
            <small class="text-muted">Seluruh kelompok tani</small>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL LUAS LAHAN SAWIT</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ number_format($totalLuasNasional, 2) }} Ha</div>
            <small class="text-muted">Agregat wilayah</small>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card-modern p-3 h-100">
            <div class="text-muted small font-weight-bold mb-1">TOTAL PRODUKSI TBS</div>
            <div class="h4 font-weight-bold text-dark mb-1">{{ number_format($totalPanenNasional, 0, ',', '.') }} Kg</div>
            <small class="text-success">Seluruh kelompok</small>
        </div>
    </div>
</div>

<!-- Daftar Kelompok Tani Terdaftar -->
<div class="card-modern p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="font-weight-bold text-dark mb-0">Daftar Kelompok Tani Terdaftar</h6>
        <a href="{{ route('admin.kelompok') }}" class="btn btn-sm btn-outline-success" style="border-radius: 8px;">Kelola Semua Poktan</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background: #F8FAFC;">
                <tr>
                    <th class="border-0 text-muted small">NAMA KELOMPOK</th>
                    <th class="border-0 text-muted small">DESA / KECAMATAN</th>
                    <th class="border-0 text-muted small">KETUA</th>
                    <th class="border-0 text-muted small">PENGURUS AKUN</th>
                    <th class="border-0 text-muted small">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarPoktan as $item)
                <tr>
                    <td class="font-weight-bold text-dark">{{ $item->nama_kelompok }}</td>
                    <td>{{ $item->desa }}, {{ $item->kecamatan }}</td>
                    <td>{{ $item->nama_ketua }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>
                        @if($item->status_verifikasi === 'disetujui')
                            <span class="badge badge-success px-2 py-1">Disetujui</span>
                        @elseif($item->status_verifikasi === 'menunggu')
                            <span class="badge badge-warning px-2 py-1">Menunggu</span>
                        @else
                            <span class="badge badge-danger px-2 py-1">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada kelompok tani terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
