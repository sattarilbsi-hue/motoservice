<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranApiController extends Controller
{
    public function index()
    {
        $data = Pembayaran::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
            'daftarService.dataService',
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil diambil.',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:pembayarans,daftar_service_id',
            ],
            'jumlah_biaya_servis' => ['required', 'numeric', 'min:0'],
            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Cash / Tunai', 'Non Tunai']),
            ],
            'keterangan' => ['nullable', 'string'],
        ]);

        $daftarService = DaftarService::with('dataService')
            ->find($validated['daftar_service_id']);

        if (!$daftarService || !$daftarService->dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran hanya dapat dibuat untuk service yang sudah memiliki Data Service.',
            ], 422);
        }

        $pembayaran = Pembayaran::create($validated);

        $pembayaran->load([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
            'daftarService.dataService',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil ditambahkan.',
            'data' => $pembayaran,
        ], 201);
    }

    public function show(string $id)
    {
        $pembayaran = Pembayaran::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
            'daftarService.dataService',
        ])->find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pembayaran,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                Rule::unique('pembayarans', 'daftar_service_id')
                    ->ignore($pembayaran->id),
            ],
            'jumlah_biaya_servis' => ['required', 'numeric', 'min:0'],
            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Cash / Tunai', 'Non Tunai']),
            ],
            'keterangan' => ['nullable', 'string'],
        ]);

        $daftarService = DaftarService::with('dataService')
            ->find($validated['daftar_service_id']);

        if (!$daftarService || !$daftarService->dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran hanya dapat dibuat untuk service yang sudah memiliki Data Service.',
            ], 422);
        }

        $pembayaran->update($validated);

        $pembayaran->load([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
            'daftarService.dataService',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diperbarui.',
            'data' => $pembayaran,
        ], 200);
    }

    public function destroy(string $id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan.',
            ], 404);
        }

        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil dihapus.',
        ], 200);
    }
}
