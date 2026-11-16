<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarServiceApiController extends Controller
{
    public function index()
    {
        $data = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService',
            'pembayaran',
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil diambil.',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => [
                'required',
                'string',
                'max:50',
                'unique:daftar_services,id_servis_pelanggan',
            ],
            'kendaraan_id' => ['required', 'exists:kendaraans,id'],
            'pelanggan_id' => ['required', 'exists:pelanggans,id'],
            'keluhan_kendaraan' => ['required', 'string'],
            'tanggal_servis' => ['required', 'date'],
        ]);

        $daftarService = DaftarService::create($validated);

        $daftarService->load(['pelanggan', 'kendaraan']);

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil ditambahkan.',
            'data' => $daftarService,
        ], 201);
    }

    public function show(string $id)
    {
        $daftarService = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService',
            'pembayaran',
        ])->find($id);

        if (!$daftarService) {
            return response()->json([
                'success' => false,
                'message' => 'Daftar service tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $daftarService,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $daftarService = DaftarService::find($id);

        if (!$daftarService) {
            return response()->json([
                'success' => false,
                'message' => 'Daftar service tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'id_servis_pelanggan' => [
                'required',
                'string',
                'max:50',
                Rule::unique('daftar_services', 'id_servis_pelanggan')
                    ->ignore($daftarService->id),
            ],
            'kendaraan_id' => ['required', 'exists:kendaraans,id'],
            'pelanggan_id' => ['required', 'exists:pelanggans,id'],
            'keluhan_kendaraan' => ['required', 'string'],
            'tanggal_servis' => ['required', 'date'],
        ]);

        $daftarService->update($validated);

        $daftarService->load(['pelanggan', 'kendaraan']);

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil diperbarui.',
            'data' => $daftarService,
        ], 200);
    }

    public function destroy(string $id)
    {
        $daftarService = DaftarService::find($id);

        if (!$daftarService) {
            return response()->json([
                'success' => false,
                'message' => 'Daftar service tidak ditemukan.',
            ], 404);
        }

        if (
            $daftarService->dataService()->exists() ||
            $daftarService->pembayaran()->exists()
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Daftar service tidak dapat dihapus karena sudah memiliki data service atau pembayaran.',
            ], 422);
        }

        $daftarService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Daftar service berhasil dihapus.',
        ], 200);
    }
}
