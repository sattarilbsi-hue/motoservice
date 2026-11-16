<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataServiceApiController extends Controller
{
    public function index()
    {
        $data = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
        ])->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil diambil.',
            'data' => $data,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:data_services,daftar_service_id',
            ],
            'keluhan_kendaraan' => ['required', 'string'],
            'estimasi_service' => ['required', 'numeric', 'min:0'],
            'nama_mekanik' => ['required', 'string', 'max:100'],
            'sparepart_pengganti' => ['nullable', 'string'],
        ]);

        $dataService = DataService::create($validated);

        $dataService->load([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil ditambahkan.',
            'data' => $dataService,
        ], 201);
    }

    public function show(string $id)
    {
        $dataService = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
        ])->find($id);

        if (!$dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Data service tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $dataService,
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $dataService = DataService::find($id);

        if (!$dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Data service tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                Rule::unique('data_services', 'daftar_service_id')
                    ->ignore($dataService->id),
            ],
            'keluhan_kendaraan' => ['required', 'string'],
            'estimasi_service' => ['required', 'numeric', 'min:0'],
            'nama_mekanik' => ['required', 'string', 'max:100'],
            'sparepart_pengganti' => ['nullable', 'string'],
        ]);

        $dataService->update($validated);

        $dataService->load([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil diperbarui.',
            'data' => $dataService,
        ], 200);
    }

    public function destroy(string $id)
    {
        $dataService = DataService::find($id);

        if (!$dataService) {
            return response()->json([
                'success' => false,
                'message' => 'Data service tidak ditemukan.',
            ], 404);
        }

        $dataService->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data service berhasil dihapus.',
        ], 200);
    }
}
