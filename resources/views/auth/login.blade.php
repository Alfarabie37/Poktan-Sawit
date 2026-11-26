<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - PoktanSawit</title>
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F4F6F5; }
        .btn-poktan { background-color: #1B5E3A; color: #fff; border-radius: 8px; }
        .btn-poktan:hover { background-color: #14472C; color: #fff; }
        .brand-badge { width: 44px; height: 44px; background: #1B5E3A; color: #fff; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 20px; }
        .role-switcher { background: #EEF2F0; padding: 4px; border-radius: 10px; display: flex; gap: 4px; }
        .role-btn { flex: 1; border: none; background: transparent; padding: 8px 12px; border-radius: 8px; font-size: 13px; font-weight: 600; color: #5C6B63; cursor: pointer; transition: all .2s; }
        .role-btn.active { background: #FFFFFF; color: #1B5E3A; box-shadow: 0 2px 6px rgba(0,0,0,0.06); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <div class="brand-badge mb-2">P</div>
                            <h4 class="font-weight-bold text-dark mb-1">PoktanSawit</h4>
                            <p class="text-muted small mb-0">Pilih peran akun Anda untuk masuk ke sistem</p>
                        </div>

                        <!-- Pemilih Role: Pengguna (Pengurus) vs Super Admin -->
                        <div class="role-switcher mb-4">
                            <button type="button" id="btn-pengurus" class="role-btn active" onclick="pilihRole('pengurus')">
                                <i class="fas fa-users mr-1"></i> Pengguna (Pengurus)
                            </button>
                            <button type="button" id="btn-admin" class="role-btn" onclick="pilihRole('super_admin')">
                                <i class="fas fa-user-shield mr-1"></i> Super Admin
                            </button>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success small">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger small">{{ $errors->first() }}</div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="selected_role" id="selected_role" value="{{ old('selected_role', 'pengurus') }}">

                            <div class="form-group">
                                <label class="small font-weight-bold text-dark">Email</label>
                                <input type="email" name="email" id="email_input" class="form-control" style="border-radius: 8px;" placeholder="Masukkan email Anda" value="{{ old('email') }}" required autofocus>
                            </div>
                            <div class="form-group">
                                <label class="small font-weight-bold text-dark">Kata Sandi</label>
                                <input type="password" name="password" class="form-control" style="border-radius: 8px;" placeholder="Masukkan kata sandi" required>
                            </div>
                            <div class="form-group d-flex justify-content-between align-items-center">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                    <label class="custom-control-label" for="remember">Ingat saya</label>
                                </div>
                            </div>
                            <button type="submit" id="submit_btn" class="btn btn-poktan btn-block py-2 font-weight-bold">
                                Masuk sebagai Pengurus
                            </button>
                        </form>

                        <div id="register_link" class="text-center mt-4">
                            <span class="small text-muted">Kelompok tani belum terdaftar?</span>
                            <a href="{{ route('register') }}" class="small font-weight-bold" style="color: #1B5E3A;">Daftar Kelompok Baru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function pilihRole(role) {
            document.getElementById('selected_role').value = role;
            const btnPengurus = document.getElementById('btn-pengurus');
            const btnAdmin = document.getElementById('btn-admin');
            const submitBtn = document.getElementById('submit_btn');
            const registerLink = document.getElementById('register_link');

            if (role === 'super_admin') {
                btnAdmin.classList.add('active');
                btnPengurus.classList.remove('active');
                submitBtn.innerText = 'Masuk sebagai Super Admin';
                registerLink.style.display = 'none';
            } else {
                btnPengurus.classList.add('active');
                btnAdmin.classList.remove('active');
                submitBtn.innerText = 'Masuk sebagai Pengurus';
                registerLink.style.display = 'block';
            }
        }

        pilihRole("{{ old('selected_role', 'pengurus') }}");
    </script>
</body>
</html>
