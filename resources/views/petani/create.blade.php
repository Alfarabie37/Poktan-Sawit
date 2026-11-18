@extends('layouts.app')

@section('title', 'Tambah Petani - Poktan-Sawit')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tambah Data Petani</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Form Input Petani Baru</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('petani.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>NIK (16 Digit)</label>
                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" maxlength="16" placeholder="Contoh: 1471012345678901" required>
                @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Nama Lengkap Petani</label>
                <input type="text" name="nama_petani" class="form-control @error('nama_petani') is-invalid @enderror" value="{{ old('nama_petani') }}" placeholder="Masukkan nama petani" required>
                @error('nama_petani') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Nomor HP / WhatsApp</label>
                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required>
                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat domisili" required>{{ old('alamat') }}</textarea>
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Luas Lahan Sawit (Hektar)</label>
                <input type="number" step="0.01" name="luas_lahan" class="form-control @error('luas_lahan') is-invalid @enderror" value="{{ old('luas_lahan') }}" placeholder="Contoh: 2.50" required>
                @error('luas_lahan') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan Data</button>
            <a href="{{ route('petani.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection