@extends('layouts.app')

@section('title', 'Distribusi Pupuk - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Distribusi Pupuk Kelompok Tani</h1>
    <a href="{{ route('pupuk.create') }}" class="btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Catat Distribusi Pupuk
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
        <h6 class="m-0 font-weight-bold text-success">Riwayat Penyaluran Pupuk Anggota</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Penerima (Petani)</th>
                        <th>Jenis Pupuk</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Total Berat</th>
                        <th width="14%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pupuks as $index => $pupuk)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($pupuk->tanggal_distribusi)->format('d/m/Y') }}</td>
                        <td>{{ $pupuk->petani->nama_petani }}</td>
                        <td>{{ $pupuk->jenis_pupuk }}</td>
                        <td>
                            @if ($pupuk->kategori == 'Subsidi')
                                <span class="badge badge-primary">Subsidi</span>
                            @else
                                <span class="badge badge-secondary">Non-Subsidi</span>
                            @endif
                        </td>
                        <td>{{ $pupuk->jumlah_sak }} Sak</td>
                        <td class="font-weight-bold">{{ number_format($pupuk->berat_total_kg, 0, ',', '.') }} Kg</td>
                        <td>
                            <a href="{{ route('pupuk.edit', $pupuk->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pupuk.destroy', $pupuk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data distribusi pupuk ini?')">
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
                        <td colspan="8" class="text-center text-muted">Belum ada catatan distribusi pupuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection