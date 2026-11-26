<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Models\Petani;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LahanController extends Controller
{
    public function index()
    {
        $lahans = Lahan::with('petani')->latest()->get();
        return view('lahan.index', compact('lahans'));
    }

    public function create()
    {
        $petanis = Petani::orderBy('nama_petani')->get();
        return view('lahan.create', compact('petanis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'petani_id'   => 'required|exists:petanis,id',
            'kode_lahan'  => 'required|unique:lahans,kode_lahan|max:20',
            'lokasi'      => 'required|string|max:255',
            'luas_hektar' => 'required|numeric|min:0.01',
            'jenis_bibit' => 'required|string|max:100',
            'tahun_tanam' => 'required|integer|min:1990|max:' . date('Y'),
        ]);

        Lahan::create($request->all());

        return redirect()->route('lahan.index')->with('success', 'Data lahan sawit berhasil ditambahkan!');
    }

    public function edit(Lahan $lahan)
    {
        $petanis = Petani::orderBy('nama_petani')->get();
        return view('lahan.edit', compact('lahan', 'petanis'));
    }

    public function update(Request $request, Lahan $lahan)
    {
        $request->validate([
            'petani_id'   => 'required|exists:petanis,id',
            'kode_lahan'  => 'required|max:20|unique:lahans,kode_lahan,' . $lahan->id,
            'lokasi'      => 'required|string|max:255',
            'luas_hektar' => 'required|numeric|min:0.01',
            'jenis_bibit' => 'required|string|max:100',
            'tahun_tanam' => 'required|integer|min:1990|max:' . date('Y'),
        ]);

        $lahan->update($request->all());

        return redirect()->route('lahan.index')->with('success', 'Data lahan sawit berhasil diperbarui!');
    }

    public function destroy(Lahan $lahan)
    {
        $lahan->delete();

        return redirect()->route('lahan.index')->with('success', 'Data lahan sawit berhasil dihapus!');
    }
}
