<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar data pelanggan berhasil diambil.',
            'data' => Pelanggan::latest()->get(),
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pelanggan' => ['required', 'string', 'max:50', 'unique:pelanggans,id_pelanggan'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'pekerjaan' => ['required', 'string', 'max:100'],
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditambahkan.',
            'data' => $pelanggan,
        ], 201);
    }

    public function show(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pelanggan,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'id_pelanggan' => [
                'required',
                'string',
                'max:50',
                Rule::unique('pelanggans', 'id_pelanggan')->ignore($pelanggan->id),
            ],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat' => ['required', 'string'],
            'pekerjaan' => ['required', 'string', 'max:100'],
        ]);

        $pelanggan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diperbarui.',
            'data' => $pelanggan,
        ], 200);
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan.',
            ], 404);
        }

        if ($pelanggan->daftarServices()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Pelanggan tidak dapat dihapus karena sudah memiliki data service.',
            ], 422);
        }

        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil dihapus.',
        ], 200);
    }
}
