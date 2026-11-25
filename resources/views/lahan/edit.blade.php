@extends('layouts.app')

@section('title', 'Edit Data Lahan - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Data Lahan Sawit</h1>
    <a href="{{ route('lahan.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('lahan.update', $lahan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="petani_id">Pemilik Lahan (Petani)</label>
                <select name="petani_id" id="petani_id" class="form-control @error('petani_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Petani --</option>
                    @foreach ($petanis as $petani)
                        <option value="{{ $petani->id }}" {{ old('petani_id', $lahan->petani_id) == $petani->id ? 'selected' : '' }}>
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
                        <input type="text" name="kode_lahan" id="kode_lahan" class="form-control @error('kode_lahan') is-invalid @enderror" value="{{ old('kode_lahan', $lahan->kode_lahan) }}" required>
                        @error('kode_lahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="luas_hektar">Luas Lahan (Hektar)</label>
                        <input type="number" step="0.01" name="luas_hektar" id="luas_hektar" class="form-control @error('luas_hektar') is-invalid @enderror" value="{{ old('luas_hektar', $lahan->luas_hektar) }}" required>
                        @error('luas_hektar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi / Alamat Kebun</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" value="{{ old('lokasi', $lahan->lokasi) }}" required>
                @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis_bibit">Jenis Bibit Sawit</label>
                        <select name="jenis_bibit" id="jenis_bibit" class="form-control @error('jenis_bibit') is-invalid @enderror" required>
                            @foreach (['Marihat (PPKS)', 'Topaz (Asian Agri)', 'Socfindo', 'Lonsum', 'Dami Mas'] as $bibit)
                                <option value="{{ $bibit }}" {{ old('jenis_bibit', $lahan->jenis_bibit) == $bibit ? 'selected' : '' }}>{{ $bibit }}</option>
                            @endforeach
                        </select>
                        @error('jenis_bibit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun_tanam">Tahun Tanam</label>
                        <input type="number" name="tahun_tanam" id="tahun_tanam" class="form-control @error('tahun_tanam') is-invalid @enderror" value="{{ old('tahun_tanam', $lahan->tahun_tanam) }}" min="1990" max="{{ date('Y') }}" required>
                        @error('tahun_tanam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update Data Lahan</button>
        </form>
    </div>
</div>
@endsection