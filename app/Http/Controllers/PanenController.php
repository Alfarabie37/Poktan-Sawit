<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use App\Models\Lahan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanenController extends Controller
{
    public function index()
    {
        $panens = Panen::with('lahan.petani')->latest('tanggal_panen')->get();
        return view('panen.index', compact('panens'));
    }

    public function create()
    {
        $lahans = Lahan::with('petani')->orderBy('kode_lahan')->get();
        return view('panen.create', compact('lahans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lahan_id'      => 'required|exists:lahans,id',
            'tanggal_panen' => 'required|date',
            'berat_kg'      => 'required|numeric|min:1',
            'harga_per_kg'  => 'required|numeric|min:100',
            'keterangan'    => 'nullable|string|max:255',
        ]);

        $totalPendapatan = $request->berat_kg * $request->harga_per_kg;

        Panen::create([
            'lahan_id'         => $request->lahan_id,
            'tanggal_panen'    => $request->tanggal_panen,
            'berat_kg'         => $request->berat_kg,
            'harga_per_kg'     => $request->harga_per_kg,
            'total_pendapatan' => $totalPendapatan,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('panen.index')->with('success', 'Data hasil panen TBS berhasil dicatat!');
    }

    public function edit(Panen $panen)
    {
        $lahans = Lahan::with('petani')->orderBy('kode_lahan')->get();
        return view('panen.edit', compact('panen', 'lahans'));
    }

    public function update(Request $request, Panen $panen)
    {
        $request->validate([
            'lahan_id'      => 'required|exists:lahans,id',
            'tanggal_panen' => 'required|date',
            'berat_kg'      => 'required|numeric|min:1',
            'harga_per_kg'  => 'required|numeric|min:100',
            'keterangan'    => 'nullable|string|max:255',
        ]);

        $totalPendapatan = $request->berat_kg * $request->harga_per_kg;

        $panen->update([
            'lahan_id'         => $request->lahan_id,
            'tanggal_panen'    => $request->tanggal_panen,
            'berat_kg'         => $request->berat_kg,
            'harga_per_kg'     => $request->harga_per_kg,
            'total_pendapatan' => $totalPendapatan,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('panen.index')->with('success', 'Data hasil panen TBS berhasil diperbarui!');
    }

    public function destroy(Panen $panen)
    {
        $panen->delete();

        return redirect()->route('panen.index')->with('success', 'Data hasil panen TBS berhasil dihapus!');
    }
}
