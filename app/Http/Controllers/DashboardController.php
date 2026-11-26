<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KelompokTani;
use App\Models\Petani;
use App\Models\Lahan;
use App\Models\Panen;
use App\Models\Pupuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'super_admin') {
            return redirect()->route('admin.dashboard');
        }

        $poktan = $user->kelompokTani;
        $poktanId = $poktan ? $poktan->id : 0;

        $totalPetani = Petani::where('kelompok_tani_id', $poktanId)->count();
        $totalLahan = Lahan::whereHas('petani', fn($q) => $q->where('kelompok_tani_id', $poktanId))->count();
        $totalLuasLahan = Lahan::whereHas('petani', fn($q) => $q->where('kelompok_tani_id', $poktanId))->sum('luas_hektar');
        $rataRataLahan = $totalPetani > 0 ? $totalLuasLahan / $totalPetani : 0;

        $totalPanenKg = Panen::whereHas('lahan.petani', fn($q) => $q->where('kelompok_tani_id', $poktanId))->sum('berat_kg');

        // Cek kolom berat/jumlah yang tersedia di tabel pupuks
        $kolomPupuk = Schema::hasColumn('pupuks', 'total_berat_kg')
            ? 'total_berat_kg'
            : (Schema::hasColumn('pupuks', 'berat_kg') ? 'berat_kg' : 'jumlah_sak');

        $totalPupukKg = Pupuk::whereHas('petani', fn($q) => $q->where('kelompok_tani_id', $poktanId))->sum($kolomPupuk);

        $petaniTerbaru = Petani::with('lahans')
            ->where('kelompok_tani_id', $poktanId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'poktan',
            'totalPetani',
            'totalLahan',
            'totalLuasLahan',
            'rataRataLahan',
            'totalPanenKg',
            'totalPupukKg',
            'petaniTerbaru'
        ));
    }

    public function adminIndex()
    {
        if (Auth::user()->role !== 'super_admin') {
            return redirect()->route('dashboard');
        }

        $totalPoktan = KelompokTani::count();
        $poktanAktif = KelompokTani::where('status_verifikasi', 'disetujui')->count();
        $menungguVerifikasi = KelompokTani::where('status_verifikasi', 'menunggu')->count();
        $totalPetaniNasional = Petani::count();
        $totalLuasNasional = Lahan::sum('luas_hektar');
        $totalPanenNasional = Panen::sum('berat_kg');

        $daftarPoktan = KelompokTani::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalPoktan',
            'poktanAktif',
            'menungguVerifikasi',
            'totalPetaniNasional',
            'totalLuasNasional',
            'totalPanenNasional',
            'daftarPoktan'
        ));
    }
}
