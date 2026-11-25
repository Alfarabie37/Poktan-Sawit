<?php

namespace App\Http\Controllers;

use App\Models\Petani;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPetani = Petani::count();
        $totalLuasLahan = Petani::sum('luas_lahan');
        $rataRataLahan = $totalPetani > 0 ? $totalLuasLahan / $totalPetani : 0;
        $petaniTerbaru = Petani::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPetani',
            'totalLuasLahan',
            'rataRataLahan',
            'petaniTerbaru'
        ));
    }
}