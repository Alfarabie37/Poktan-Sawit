@extends('layouts.app')

@section('title', 'Catat Distribusi Pupuk - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Catat Distribusi Pupuk</h1>
    <a href="{{ route('pupuk.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('pupuk.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="petani_id">Nama Petani Penerima</label>
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
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_distribusi">Tanggal Penyaluran</label>
                        <input type="date" name="tanggal_distribusi" id="tanggal_distribusi" class="form-control @error('tanggal_distribusi') is-invalid @enderror" value="{{ old('tanggal_distribusi', date('Y-m-d')) }}" required>
                        @error('tanggal_distribusi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jenis_pupuk">Jenis Pupuk Sawit</label>
                        <select name="jenis_pupuk" id="jenis_pupuk" class="form-control @error('jenis_pupuk') is-invalid @enderror" required>
                            <option value="">-- Pilih Jenis Pupuk --</option>
                            <option value="NPK Phonska" {{ old('jenis_pupuk') == 'NPK Phonska' ? 'selected' : '' }}>NPK Phonska</option>
                            <option value="Urea" {{ old('jenis_pupuk') == 'Urea' ? 'selected' : '' }}>Urea</option>
                            <option value="KCl / MOP" {{ old('jenis_pupuk') == 'KCl / MOP' ? 'selected' : '' }}>KCl / MOP</option>
                            <option value="Dolomit" {{ old('jenis_pupuk') == 'Dolomit' ? 'selected' : '' }}>Dolomit</option>
                            <option value="Kieserite" {{ old('jenis_pupuk') == 'Kieserite' ? 'selected' : '' }}>Kieserite</option>
                        </select>
                        @error('jenis_pupuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kategori">Kategori Pupuk</label>
                        <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                            <option value="Subsidi" {{ old('kategori') == 'Subsidi' ? 'selected' : '' }}>Subsidi</option>
                            <option value="Non-Subsidi" {{ old('kategori') == 'Non-Subsidi' ? 'selected' : '' }}>Non-Subsidi</option>
                        </select>
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jumlah_sak">Jumlah (Sak @ 50 Kg)</label>
                        <input type="number" name="jumlah_sak" id="jumlah_sak" class="form-control @error('jumlah_sak') is-invalid @enderror" value="{{ old('jumlah_sak') }}" min="1" placeholder="Contoh: 5" required>
                        @error('jumlah_sak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan (Opsional)</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" placeholder="Contoh: Tahap I pemupukan semester ganjil">
                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Distribusi Pupuk</button>
        </form>
    </div>
</div>
@endsection