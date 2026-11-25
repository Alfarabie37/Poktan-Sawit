@extends('layouts.app')

@section('title', 'Tambah Data Lahan - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Lahan Sawit</h1>
    <a href="{{ route('lahan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('lahan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="petani_id">Pemilik Lahan (Petani)</label>
                <select name="petani_id" id="petani_id" class="form-control @error('petani_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Petani --</option>
                    @foreach ($petanis as $petani)
                        <option value="{{ $petani->id }}" {{ old('petani_id') == $petani->id ? 'selected' : '' }}>
                            {{ $petani->nama_petani }} (NIK: {{ $petani->nik }})
                        </option>
                    @endforeach
                </select>
                @error('petani_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_lahan">Kode Lahan / Blok</label>
                        <input type="text" name="kode_lahan" id="kode_lahan" class="form-control @error('kode_lahan') is-invalid @enderror" value="{{ old('kode_lahan') }}" placeholder="Contoh: BLK-A01" required>
                        @error('kode_lahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="luas_hektar">Luas Lahan (Hektar)</label>
                        <input type="number" step="0.01" name="luas_hektar" id="luas_hektar" class="form-control @error('luas_hektar') is-invalid @enderror" value="{{ old('luas_hektar') }}" placeholder="Contoh: 2.50" required>
                        @error('luas_hektar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi / Alamat Kebun</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi') }}" placeholder="Contoh: Desa Sei Rampah, Blok Timur" required>
                @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis_bibit">Jenis Bibit Sawit</label>
                        <select name="jenis_bibit" id="jenis_bibit" class="form-control @error('jenis_bibit') is-invalid @enderror" required>
                            <option value="">-- Pilih Varietas Bibit --</option>
                            <option value="Marihat (PPKS)" {{ old('jenis_bibit') == 'Marihat (PPKS)' ? 'selected' : '' }}>Marihat (PPKS)</option>
                            <option value="Topaz (Asian Agri)" {{ old('jenis_bibit') == 'Topaz (Asian Agri)' ? 'selected' : '' }}>Topaz (Asian Agri)</option>
                            <option value="Socfindo" {{ old('jenis_bibit') == 'Socfindo' ? 'selected' : '' }}>Socfindo</option>
                            <option value="Lonsum" {{ old('jenis_bibit') == 'Lonsum' ? 'selected' : '' }}>Lonsum</option>
                            <option value="Dami Mas" {{ old('jenis_bibit') == 'Dami Mas' ? 'selected' : '' }}>Dami Mas</option>
                        </select>
                        @error('jenis_bibit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun_tanam">Tahun Tanam</label>
                        <input type="number" name="tahun_tanam" id="tahun_tanam" class="form-control @error('tahun_tanam') is-invalid @enderror" value="{{ old('tahun_tanam', date('Y')) }}" min="1990" max="{{ date('Y') }}" required>
                        @error('tahun_tanam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data Lahan</button>
        </form>
    </div>
</div>
@endsection