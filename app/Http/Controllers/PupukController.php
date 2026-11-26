<?php

namespace App\Http\Controllers;

use App\Models\Pupuk;
use App\Models\Petani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PupukController extends Controller
{
    public function index()
    {
        $pupuks = Pupuk::with('petani')->latest('tanggal_distribusi')->get();
        return view('pupuk.index', compact('pupuks'));
    }

    public function create()
    {
        $petanis = Petani::orderBy('nama_petani')->get();
        return view('pupuk.create', compact('petanis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'petani_id'          => 'required|exists:petanis,id',
            'tanggal_distribusi' => 'required|date',
            'jenis_pupuk'        => 'required|string|max:100',
            'kategori'           => 'required|in:Subsidi,Non-Subsidi',
            'jumlah_sak'         => 'required|integer|min:1',
            'keterangan'         => 'nullable|string|max:255',
        ]);

        // Asumsi standar 1 sak/karung pupuk = 50 Kg
        $beratTotal = $request->jumlah_sak * 50;

        Pupuk::create([
            'petani_id'          => $request->petani_id,
            'tanggal_distribusi' => $request->tanggal_distribusi,
            'jenis_pupuk'        => $request->jenis_pupuk,
            'kategori'           => $request->kategori,
            'jumlah_sak'         => $request->jumlah_sak,
            'berat_total_kg'     => $beratTotal,
            'keterangan'         => $request->keterangan,
        ]);

        return redirect()->route('pupuk.index')->with('success', 'Data distribusi pupuk berhasil dicatat!');
    }

    public function edit(Pupuk $pupuk)
    {
        $petanis = Petani::orderBy('nama_petani')->get();
        return view('pupuk.edit', compact('pupuk', 'petanis'));
    }

    public function update(Request $request, Pupuk $pupuk)
    {
        $request->validate([
            'petani_id'          => 'required|exists:petanis,id',
            'tanggal_distribusi' => 'required|date',
            'jenis_pupuk'        => 'required|string|max:100',
            'kategori'           => 'required|in:Subsidi,Non-Subsidi',
            'jumlah_sak'         => 'required|integer|min:1',
            'keterangan'         => 'nullable|string|max:255',
        ]);

        $beratTotal = $request->jumlah_sak * 50;

        $pupuk->update([
            'petani_id'          => $request->petani_id,
            'tanggal_distribusi' => $request->tanggal_distribusi,
            'jenis_pupuk'        => $request->jenis_pupuk,
            'kategori'           => $request->kategori,
            'jumlah_sak'         => $request->jumlah_sak,
            'berat_total_kg'     => $beratTotal,
            'keterangan'         => $request->keterangan,
        ]);

        return redirect()->route('pupuk.index')->with('success', 'Data distribusi pupuk berhasil diperbarui!');
    }

    public function destroy(Pupuk $pupuk)
    {
        $pupuk->delete();

        return redirect()->route('pupuk.index')->with('success', 'Data distribusi pupuk berhasil dihapus!');
    }
}
