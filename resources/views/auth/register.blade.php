<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kelompok Tani - PoktanSawit</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F4F6F5; }
        .btn-poktan { background-color: #1B5E3A; color: #fff; border-radius: 8px; }
        .btn-poktan:hover { background-color: #14472C; color: #fff; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="font-weight-bold text-dark mb-1">Pendaftaran Kelompok Tani Baru</h4>
                        <p class="text-muted small mb-4">Lengkapi akun pengurus dan data identitas kelompok tani. Akun aktif setelah diverifikasi Super Admin.</p>

                        @if ($errors->any())
                            <div class="alert alert-danger small">
                                <ul class="mb-0 pl-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <h6 class="font-weight-bold text-success mb-3">1. Akun Pengurus</h6>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Nama Lengkap Pengurus</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Email Pengurus</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <hr>
                            <h6 class="font-weight-bold text-success mb-3">2. Identitas Kelompok Tani</h6>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Nama Kelompok Tani</label>
                                    <input type="text" name="nama_kelompok" class="form-control" value="{{ old('nama_kelompok') }}" placeholder="Contoh: Tani Sawit Sejahtera" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Nama Ketua Kelompok</label>
                                    <input type="text" name="nama_ketua" class="form-control" value="{{ old('nama_ketua') }}" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="small font-weight-bold">Desa / Kelurahan</label>
                                    <input type="text" name="desa" class="form-control" value="{{ old('desa') }}" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="small font-weight-bold">Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label class="small font-weight-bold">Tahun Berdiri</label>
                                    <input type="number" name="tahun_berdiri" class="form-control" value="{{ old('tahun_berdiri', 2020) }}" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Nomor Telepon Pengurus</label>
                                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="small font-weight-bold">Alamat Sekretariat</label>
                                    <input type="text" name="alamat_sekretariat" class="form-control" value="{{ old('alamat_sekretariat') }}" placeholder="Jalan, RT/RW, patokan lokasi">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <a href="{{ route('login') }}" class="small text-muted">Sudah punya akun? Masuk</a>
                                <button type="submit" class="btn btn-poktan px-4 py-2 font-weight-bold">Kirim Pendaftaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
