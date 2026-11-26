<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KelompokTani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'         => 'required|email',
            'password'      => 'required',
            'selected_role' => 'required|in:super_admin,pengurus',
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $user = Auth::user();

            // TOLAK jika akun tidak sesuai dengan tab peran yang dipilih
            if ($user->role !== $credentials['selected_role']) {
                Auth::logout();
                $namaPeran = $credentials['selected_role'] === 'super_admin' ? 'Super Admin' : 'Pengguna (Pengurus)';
                return back()->withErrors([
                    'email' => "Akun ini bukan akun {$namaPeran}. Silakan pilih tab peran yang sesuai.",
                ])->withInput();
            }

            if ($user->status === 'menunggu') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda masih menunggu verifikasi dari Super Admin.'])->withInput();
            }

            if ($user->status === 'nonaktif') {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda dinonaktifkan. Hubungi Super Admin.'])->withInput();
            }

            $request->session()->regenerate();

            return $user->role === 'super_admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:100',
            'email'              => 'required|email|unique:users,email',
            'password'           => 'required|min:6|confirmed',
            'nama_kelompok'      => 'required|string|max:150',
            'desa'               => 'required|string|max:100',
            'kecamatan'          => 'required|string|max:100',
            'nama_ketua'         => 'required|string|max:100',
            'tahun_berdiri'      => 'required|integer|min:1980|max:' . date('Y'),
            'no_hp'              => 'required|string|max:20',
            'alamat_sekretariat' => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pengurus',
            'status'   => 'aktif',
        ]);

        KelompokTani::create([
            'user_id'            => $user->id,
            'nama_kelompok'      => $request->nama_kelompok,
            'desa'               => $request->desa,
            'kecamatan'          => $request->kecamatan,
            'nama_ketua'         => $request->nama_ketua,
            'tahun_berdiri'      => $request->tahun_berdiri,
            'no_hp'              => $request->no_hp,
            'alamat_sekretariat' => $request->alamat_sekretariat,
            'status_verifikasi'  => 'disetujui',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk menggunakan email dan kata sandi Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
