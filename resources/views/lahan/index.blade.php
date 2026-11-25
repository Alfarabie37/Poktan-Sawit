@extends('layouts.app')

@section('title', 'Data Lahan Sawit - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Lahan Sawit</h1>
    <a href="{{ route('lahan.create') }}" class="btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data Lahan
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
        <h6 class="m-0 font-weight-bold text-success">Daftar Kebun / Lahan Kelapa Sawit</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Lahan</th>
                        <th>Pemilik (Petani)</th>
                        <th>Lokasi Kebun</th>
                        <th>Luas Lahan</th>
                        <th>Jenis Bibit</th>
                        <th>Tahun Tanam</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lahans as $index => $lahan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="badge badge-success">{{ $lahan->kode_lahan }}</span></td>
                        <td>{{ $lahan->petani->nama_petani }}</td>
                        <td>{{ $lahan->lokasi }}</td>
                        <td>{{ number_format($lahan->luas_hektar, 2) }} Ha</td>
                        <td>{{ $lahan->jenis_bibit }}</td>
                        <td>{{ $lahan->tahun_tanam }}</td>
                        <td>
                            <a href="{{ route('lahan.edit', $lahan->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('lahan.destroy', $lahan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data lahan ini?')">
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
                        <td colspan="8" class="text-center text-muted">Belum ada data lahan sawit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection