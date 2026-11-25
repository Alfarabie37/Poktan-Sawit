@extends('layouts.app')

@section('title', 'Catat Hasil Panen - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Catat Hasil Panen (TBS)</h1>
    <a href="{{ route('panen.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('panen.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lahan_id">Pilih Lahan / Blok Kebun</label>
                        <select name="lahan_id" id="lahan_id" class="form-control @error('lahan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Lahan & Pemilik --</option>
                            @foreach ($lahans as $lahan)
                                <option value="{{ $lahan->id }}" {{ old('lahan_id') == $lahan->id ? 'selected' : '' }}>
                                    {{ $lahan->kode_lahan }} - {{ $lahan->petani->nama_petani }} ({{ $lahan->lokasi }})
                                </option>
                            @endforeach
                        </select>
                        @error('lahan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_panen">Tanggal Panen</label>
                        <input type="date" name="tanggal_panen" id="tanggal_panen" class="form-control @error('tanggal_panen') is-invalid @enderror" value="{{ old('tanggal_panen', date('Y-m-d')) }}" required>
                        @error('tanggal_panen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="berat_kg">Berat Timbangan TBS (Kg)</label>
                        <input type="number" step="0.01" name="berat_kg" id="berat_kg" class="form-control @error('berat_kg') is-invalid @enderror" value="{{ old('berat_kg') }}" placeholder="Contoh: 1250" required>
                        @error('berat_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_per_kg">Harga Sawit per Kg (Rp)</label>
                        <input type="number" name="harga_per_kg" id="harga_per_kg" class="form-control @error('harga_per_kg') is-invalid @enderror" value="{{ old('harga_per_kg', 2850) }}" placeholder="Contoh: 2850" required>
                        @error('harga_per_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan / Catatan Pabrik (Opsional)</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan') }}" placeholder="Contoh: Kirim ke PKS Sei Rokan, buah matang normal">
                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Transaksi Panen</button>
        </form>
    </div>
</div>
@endsection