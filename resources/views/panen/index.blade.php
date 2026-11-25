@extends('layouts.app')

@section('title', 'Hasil Panen (TBS) - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi Hasil Panen (TBS)</h1>
    <a href="{{ route('panen.create') }}" class="btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Catat Panen Baru
    </a>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Riwayat Timbangan & Penjualan TBS</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Lahan</th>
                        <th>Nama Petani</th>
                        <th>Berat TBS</th>
                        <th>Harga / Kg</th>
                        <th>Total Pendapatan</th>
                        <th width="14%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($panens as $index => $panen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($panen->tanggal_panen)->format('d/m/Y') }}</td>
                        <td><span class="badge badge-success">{{ $panen->lahan->kode_lahan }}</span></td>
                        <td>{{ $panen->lahan->petani->nama_petani }}</td>
                        <td>{{ number_format($panen->berat_kg, 0, ',', '.') }} Kg</td>
                        <td>Rp {{ number_format($panen->harga_per_kg, 0, ',', '.') }}</td>
                        <td class="font-weight-bold text-success">Rp {{ number_format($panen->total_pendapatan, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('panen.edit', $panen->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('panen.destroy', $panen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data panen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada catatan hasil panen TBS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection