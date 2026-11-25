@extends('layouts.app')

@section('title', 'Edit Hasil Panen - Poktan-Sawit')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Hasil Panen (TBS)</h1>
    <a href="{{ route('panen.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('panen.update', $panen->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lahan_id">Pilih Lahan / Blok Kebun</label>
                        <select name="lahan_id" id="lahan_id" class="form-control @error('lahan_id') is-invalid @enderror" required>
                            @foreach ($lahans as $lahan)
                                <option value="{{ $lahan->id }}" {{ old('lahan_id', $panen->lahan_id) == $lahan->id ? 'selected' : '' }}>
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
                        <input type="date" name="tanggal_panen" id="tanggal_panen" class="form-control @error('tanggal_panen') is-invalid @enderror" value="{{ old('tanggal_panen', $panen->tanggal_panen) }}" required>
                        @error('tanggal_panen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="berat_kg">Berat Timbangan TBS (Kg)</label>
                        <input type="number" step="0.01" name="berat_kg" id="berat_kg" class="form-control @error('berat_kg') is-invalid @enderror" value="{{ old('berat_kg', $panen->berat_kg) }}" required>
                        @error('berat_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga_per_kg">Harga Sawit per Kg (Rp)</label>
                        <input type="number" name="harga_per_kg" id="harga_per_kg" class="form-control @error('harga_per_kg') is-invalid @enderror" value="{{ old('harga_per_kg', $panen->harga_per_kg) }}" required>
                        @error('harga_per_kg')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan / Catatan Pabrik (Opsional)</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan', $panen->keterangan) }}">
                @error('keterangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update Transaksi Panen</button>
        </form>
    </div>
</div>
@endsection