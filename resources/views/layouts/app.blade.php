<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'PoktanSawit')</title>

    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F6F8F7;
            color: #1E293B;
        }
        /* Modern White Sidebar */
        .modern-sidebar {
            width: 260px;
            min-height: 100vh;
            background: #FFFFFF;
            border-right: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }
        .sidebar-header {
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #F1F5F9;
        }
        .brand-logo {
            width: 36px;
            height: 36px;
            background: #1B5E3A;
            color: #FFFFFF;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }
        .sidebar-menu {
            padding: 16px 14px;
            flex: 1;
            overflow-y: auto;
        }
        .menu-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #94A3B8;
            padding: 12px 12px 6px;
        }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 9px;
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none !important;
            margin-bottom: 4px;
            transition: all 0.15s ease;
        }
        .menu-item i {
            width: 18px;
            text-align: center;
            font-size: 15px;
            color: #64748B;
        }
        .menu-item:hover {
            background: #F1F5F9;
            color: #1B5E3A;
        }
        .menu-item:hover i {
            color: #1B5E3A;
        }
        .menu-item.active {
            background: #E8F3EE;
            color: #1B5E3A;
            font-weight: 600;
        }
        .menu-item.active i {
            color: #1B5E3A;
        }
        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid #F1F5F9;
            background: #FAFCFB;
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #1B5E3A;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
        }
        /* Main Content Area */
        .main-area {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .top-header {
            background: #FFFFFF;
            border-bottom: 1px solid #E2E8F0;
            padding: 14px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .content-body {
            padding: 28px 32px;
            flex: 1;
        }
        .card-modern {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .btn-poktan {
            background-color: #1B5E3A;
            color: #FFFFFF;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13.5px;
            padding: 8px 16px;
            border: none;
        }
        .btn-poktan:hover {
            background-color: #14472C;
            color: #FFFFFF;
        }
        @media (max-width: 991px) {
            .modern-sidebar { position: relative; width: 100%; min-height: auto; }
            .main-area { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar Putih Modern -->
    <aside class="modern-sidebar">
        <div class="sidebar-header">
            <div class="brand-logo">P</div>
            <div>
                <div class="font-weight-bold text-dark" style="font-size: 17px; line-height: 1.2;">PoktanSawit</div>
                <small class="text-muted" style="font-size: 11px;">
                    {{ Auth::user()->role === 'super_admin' ? 'Panel Super Admin' : (Auth::user()->kelompokTani->nama_kelompok ?? 'Kelompok Tani') }}
                </small>
            </div>
        </div>

        <nav class="sidebar-menu">
            @if(Auth::user()->role === 'super_admin')
                <!-- MENU KHUSUS SUPER ADMIN -->
                <div class="menu-label">Administrasi Pusat</div>
                <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard Nasional</span>
                </a>
                <a href="{{ route('admin.verifikasi') }}" class="menu-item {{ request()->routeIs('admin.verifikasi*') ? 'active' : '' }}">
                    <i class="fas fa-check-circle"></i>
                    <span>Verifikasi Poktan</span>
                </a>
                <a href="{{ route('admin.kelompok') }}" class="menu-item {{ request()->routeIs('admin.kelompok*') ? 'active' : '' }}">
                    <i class="fas fa-building"></i>
                    <span>Semua Kelompok Tani</span>
                </a>
                <a href="{{ route('admin.pengguna') }}" class="menu-item {{ request()->routeIs('admin.pengguna*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i>
                    <span>Kelola Pengguna</span>
                </a>
                <a href="{{ route('admin.laporan') }}" class="menu-item {{ request()->routeIs('admin.laporan*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan Global</span>
                </a>
            @else
                <!-- MENU KHUSUS PENGGUNA (PENGURUS POKTAN) -->
                <div class="menu-label">Menu Utama</div>
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>

                <div class="menu-label">Data Master</div>
                <a href="{{ route('petani.index') }}" class="menu-item {{ request()->routeIs('petani.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Data Petani</span>
                </a>
                <a href="{{ route('lahan.index') }}" class="menu-item {{ request()->routeIs('lahan.*') ? 'active' : '' }}">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Data Lahan Sawit</span>
                </a>

                <div class="menu-label">Operasional & Laporan</div>
                <a href="{{ route('panen.index') }}" class="menu-item {{ request()->routeIs('panen.*') ? 'active' : '' }}">
                    <i class="fas fa-balance-scale"></i>
                    <span>Hasil Panen (TBS)</span>
                </a>
                <a href="{{ route('pupuk.index') }}" class="menu-item {{ request()->routeIs('pupuk.*') ? 'active' : '' }}">
                    <i class="fas fa-boxes"></i>
                    <span>Distribusi Pupuk</span>
                </a>
                <a href="{{ route('laporan.index') }}" class="menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan Poktan</span>
                </a>
            @endif
        </nav>

        <!-- Profil & Tombol Keluar di Kiri Bawah -->
        <div class="sidebar-footer">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center" style="gap: 10px; min-width: 0;">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div style="min-width: 0;">
                        <div class="font-weight-bold text-dark text-truncate" style="font-size: 13px;">{{ Auth::user()->name }}</div>
                        <div class="text-muted text-truncate" style="font-size: 11px;">
                            {{ Auth::user()->role === 'super_admin' ? 'Super Admin' : 'Pengurus Kelompok' }}
                        </div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light text-danger" title="Keluar" style="border-radius: 8px;">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Area Konten Kanan -->
    <div class="main-area">
        <header class="top-header">
            <div>
                <span class="text-muted small">
                    {{ Auth::user()->role === 'super_admin' ? 'Sistem Manajemen Terpusat PoktanSawit' : (Auth::user()->kelompokTani->nama_kelompok ?? 'Kelompok Tani Sawit') . ' • Desa ' . (Auth::user()->kelompokTani->desa ?? '-') }}
                </span>
            </div>
            <div class="d-flex align-items-center" style="gap: 12px;">
                <span class="badge px-3 py-2" style="background: #E8F3EE; color: #1B5E3A; border-radius: 20px; font-weight: 600;">
                    <i class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                    {{ Auth::user()->role === 'super_admin' ? 'Super Admin Aktif' : 'Status: Aktif' }}
                </span>
            </div>
        </header>

        <main class="content-body">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 10px;">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 10px;">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ $errors->first() }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
