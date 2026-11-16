<?php

namespace App\Http\Controllers;

use App\Models\DaftarService;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DaftarServiceController extends Controller
{
    /**
     * Menampilkan seluruh daftar service.
     */
    public function index()
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService',
            'pembayaran',
        ])
            ->latest()
            ->paginate(10);

        $pelangganCount = Pelanggan::count();

        return view('daftar-service.index', compact(
            'daftarServices',
            'pelangganCount'
        ));
    }

    /**
     * Menampilkan form tambah daftar service.
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_lengkap')->get();
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        return view('daftar-service.create', compact(
            'pelanggans',
            'kendaraans'
        ));
    }

    /**
     * Menyimpan daftar service baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => [
                'required',
                'string',
                'max:50',
                'unique:daftar_services,id_servis_pelanggan',
            ],
            'kendaraan_id' => [
                'required',
                'exists:kendaraans,id',
            ],
            'pelanggan_id' => [
                'required',
                'exists:pelanggans,id',
            ],
            'keluhan_kendaraan' => [
                'required',
                'string',
            ],
            'tanggal_servis' => [
                'required',
                'date',
            ],
        ]);

        DaftarService::create($validated);

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail daftar service.
     */
    public function show(DaftarService $daftarService)
    {
        $daftarService->load([
            'pelanggan',
            'kendaraan',
            'dataService',
            'pembayaran',
        ]);

        return view('daftar-service.show', compact(
            'daftarService'
        ));
    }

    /**
     * Menampilkan form edit daftar service.
     */
    public function edit(DaftarService $daftarService)
    {
        $pelanggans = Pelanggan::orderBy('nama_lengkap')->get();
        $kendaraans = Kendaraan::orderBy('no_plat')->get();

        return view('daftar-service.edit', compact(
            'daftarService',
            'pelanggans',
            'kendaraans'
        ));
    }

    /**
     * Memperbarui daftar service.
     */
    public function update(Request $request, DaftarService $daftarService)
    {
        $validated = $request->validate([
            'id_servis_pelanggan' => [
                'required',
                'string',
                'max:50',
                Rule::unique('daftar_services', 'id_servis_pelanggan')
                    ->ignore($daftarService->id),
            ],
            'kendaraan_id' => [
                'required',
                'exists:kendaraans,id',
            ],
            'pelanggan_id' => [
                'required',
                'exists:pelanggans,id',
            ],
            'keluhan_kendaraan' => [
                'required',
                'string',
            ],
            'tanggal_servis' => [
                'required',
                'date',
            ],
        ]);

        $daftarService->update($validated);

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil diperbarui.');
    }

    /**
     * Menghapus daftar service.
     */
    public function destroy(DaftarService $daftarService)
    {
        if (
            $daftarService->dataService()->exists() ||
            $daftarService->pembayaran()->exists()
        ) {
            return redirect()
                ->route('daftar-service.index')
                ->with('error', 'Daftar service tidak dapat dihapus karena sudah memiliki data service atau pembayaran.');
        }

        $daftarService->delete();

        return redirect()
            ->route('daftar-service.index')
            ->with('success', 'Daftar service berhasil dihapus.');
    }
}
