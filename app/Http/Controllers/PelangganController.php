<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:50|unique:pelanggans,id_pelanggan',
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);

        Pelanggan::create($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'id_pelanggan' => 'required|string|max:50|unique:pelanggans,id_pelanggan,' . $pelanggan->id,
            'nama_lengkap' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
        ]);

        $pelanggan->update($validated);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->daftarServices()->exists()) {
            return redirect()
                ->route('pelanggan.index')
                ->with('error', 'Pelanggan tidak dapat dihapus karena sudah memiliki data service.');
        }

        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}