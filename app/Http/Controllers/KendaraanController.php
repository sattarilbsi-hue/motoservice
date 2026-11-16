<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->get();

        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat',
            'jenis_kendaraan' => 'required|in:Matic,Manual Transimisi',
            'no_stnk' => 'required|string|max:50|unique:kendaraans,no_stnk',
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        Kendaraan::create($validated);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function show(Kendaraan $kendaraan)
    {
        return view('kendaraan.show', compact('kendaraan'));
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat,' . $kendaraan->id,
            'jenis_kendaraan' => 'required|in:Matic,Manual Transimisi',
            'no_stnk' => 'required|string|max:50|unique:kendaraans,no_stnk,' . $kendaraan->id,
            'tahun_pembuatan' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_pemilik' => 'required|string|max:100',
            'warna_kendaraan' => 'required|string|max:50',
        ]);

        $kendaraan->update($validated);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        if ($kendaraan->daftarServices()->exists()) {
            return redirect()
                ->route('kendaraan.index')
                ->with('error', 'Kendaraan tidak dapat dihapus karena sudah memiliki data service.');
        }

        $kendaraan->delete();

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus.');
    }
}