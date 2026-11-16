<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KendaraanApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Daftar data kendaraan berhasil diambil.',
            'data' => Kendaraan::latest()->get(),
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_plat' => ['required', 'string', 'max:20', 'unique:kendaraans,no_plat'],
            'jenis_kendaraan' => ['required', Rule::in(['Matic', 'Manual Transimisi'])],
            'no_stnk' => ['required', 'string', 'max:50', 'unique:kendaraans,no_stnk'],
            'tahun_pembuatan' => ['required', 'integer', 'min:1900', 'max:2100'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'warna_kendaraan' => ['required', 'string', 'max:100'],
        ]);

        $kendaraan = Kendaraan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil ditambahkan.',
            'data' => $kendaraan,
        ], 201);
    }

    public function show(string $id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Data kendaraan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $kendaraan,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Data kendaraan tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'no_plat' => [
                'required',
                'string',
                'max:20',
                Rule::unique('kendaraans', 'no_plat')->ignore($kendaraan->id),
            ],
            'jenis_kendaraan' => ['required', Rule::in(['Matic', 'Manual Transimisi'])],
            'no_stnk' => [
                'required',
                'string',
                'max:50',
                Rule::unique('kendaraans', 'no_stnk')->ignore($kendaraan->id),
            ],
            'tahun_pembuatan' => ['required', 'integer', 'min:1900', 'max:2100'],
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'warna_kendaraan' => ['required', 'string', 'max:100'],
        ]);

        $kendaraan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil diperbarui.',
            'data' => $kendaraan,
        ], 200);
    }

    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Data kendaraan tidak ditemukan.',
            ], 404);
        }

        if ($kendaraan->daftarServices()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Kendaraan tidak dapat dihapus karena sudah memiliki data service.',
            ], 422);
        }

        $kendaraan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kendaraan berhasil dihapus.',
        ], 200);
    }
}
