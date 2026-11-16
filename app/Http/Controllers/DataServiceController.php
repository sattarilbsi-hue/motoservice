<?php

namespace App\Http\Controllers;

use App\Models\DataService;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataServiceController extends Controller
{
    /**
     * Menampilkan seluruh data service.
     */
    public function index()
    {
        $dataServices = DataService::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
        ])
            ->latest()
            ->paginate(10);

        $totalDataService = DataService::count();

        $totalEstimasi = DataService::sum('estimasi_service');

        return view('data-service.index', compact(
            'dataServices',
            'totalDataService',
            'totalEstimasi'
        ));
    }

    /**
     * Menampilkan form tambah data service.
     */
    public function create()
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
        ])
            ->whereDoesntHave('dataService')
            ->latest()
            ->get();

        return view('data-service.create', compact(
            'daftarServices'
        ));
    }

    /**
     * Menyimpan data service baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:data_services,daftar_service_id',
            ],
            'keluhan_kendaraan' => [
                'required',
                'string',
            ],
            'estimasi_service' => [
                'required',
                'numeric',
                'min:0',
            ],
            'nama_mekanik' => [
                'required',
                'string',
                'max:100',
            ],
            'sparepart_pengganti' => [
                'nullable',
                'string',
            ],
        ], [
            'daftar_service_id.required' => 'ID servis pelanggan wajib dipilih.',
            'daftar_service_id.unique' => 'Data service untuk ID tersebut sudah tersedia.',
            'keluhan_kendaraan.required' => 'Keluhan kendaraan wajib diisi.',
            'estimasi_service.required' => 'Estimasi service wajib diisi.',
            'nama_mekanik.required' => 'Nama mekanik wajib diisi.',
        ]);

        DataService::create($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data service.
     */
    public function show(DataService $dataService)
    {
        $dataService->load([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
        ]);

        return view('data-service.show', compact(
            'dataService'
        ));
    }

    /**
     * Menampilkan form edit data service.
     */
    public function edit(DataService $dataService)
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
        ])
            ->where(function ($query) use ($dataService) {
                $query->whereDoesntHave('dataService')
                    ->orWhere('id', $dataService->daftar_service_id);
            })
            ->latest()
            ->get();

        return view('data-service.edit', compact(
            'dataService',
            'daftarServices'
        ));
    }

    /**
     * Memperbarui data service.
     */
    public function update(Request $request, DataService $dataService)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                Rule::unique('data_services', 'daftar_service_id')
                    ->ignore($dataService->id),
            ],
            'keluhan_kendaraan' => [
                'required',
                'string',
            ],
            'estimasi_service' => [
                'required',
                'numeric',
                'min:0',
            ],
            'nama_mekanik' => [
                'required',
                'string',
                'max:100',
            ],
            'sparepart_pengganti' => [
                'nullable',
                'string',
            ],
        ], [
            'daftar_service_id.required' => 'ID servis pelanggan wajib dipilih.',
            'daftar_service_id.unique' => 'ID servis tersebut sudah digunakan.',
            'keluhan_kendaraan.required' => 'Keluhan kendaraan wajib diisi.',
            'estimasi_service.required' => 'Estimasi service wajib diisi.',
            'nama_mekanik.required' => 'Nama mekanik wajib diisi.',
        ]);

        $dataService->update($validated);

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil diperbarui.');
    }

    /**
     * Menghapus data service.
     */
    public function destroy(DataService $dataService)
    {
        $dataService->delete();

        return redirect()
            ->route('data-service.index')
            ->with('success', 'Data service berhasil dihapus.');
    }
}
