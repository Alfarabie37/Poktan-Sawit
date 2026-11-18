@extends('layouts.app')

@section('title', 'Data Petani - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Petani Sawit</h1>
    <a href="{{ route('petani.create') }}" class="btn btn-success btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Petani
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
        <h6 class="m-0 font-weight-bold text-success">Daftar Anggota Kelompok Tani</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Petani</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Luas Lahan (Ha)</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($petanis as $index => $petani)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $petani->nik }}</td>
                        <td>{{ $petani->nama_petani }}</td>
                        <td>{{ $petani->no_hp }}</td>
                        <td>{{ $petani->alamat }}</td>
                        <td>{{ $petani->luas_lahan }} Ha</td>
                        <td>
                            <a href="{{ route('petani.edit', $petani->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('petani.destroy', $petani->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data petani ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data petani. Silakan klik tombol "Tambah Petani".</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection