<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\DaftarService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::with([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
            'daftarService.dataService',
        ])->latest()->paginate(10);

        $totalPembayaran = Pembayaran::count();
        $totalBiaya = Pembayaran::sum('jumlah_biaya_servis');

        return view('pembayaran.index', compact(
            'pembayarans',
            'totalPembayaran',
            'totalBiaya'
        ));
    }

    public function create()
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService',
        ])
            ->whereHas('dataService')
            ->whereDoesntHave('pembayaran')
            ->latest()
            ->get();

        return view('pembayaran.create', compact('daftarServices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                'unique:pembayarans,daftar_service_id',
            ],
            'jumlah_biaya_servis' => [
                'required',
                'numeric',
                'min:0',
            ],
            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Cash / Tunai', 'Non Tunai']),
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        Pembayaran::create($validated);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran service berhasil ditambahkan.');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load([
            'daftarService.pelanggan',
            'daftarService.kendaraan',
            'daftarService.dataService',
        ]);

        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        $daftarServices = DaftarService::with([
            'pelanggan',
            'kendaraan',
            'dataService',
        ])
            ->whereHas('dataService')
            ->where(function ($query) use ($pembayaran) {
                $query->whereDoesntHave('pembayaran')
                    ->orWhere('id', $pembayaran->daftar_service_id);
            })
            ->latest()
            ->get();

        return view('pembayaran.edit', compact(
            'pembayaran',
            'daftarServices'
        ));
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'daftar_service_id' => [
                'required',
                'exists:daftar_services,id',
                Rule::unique('pembayarans', 'daftar_service_id')
                    ->ignore($pembayaran->id),
            ],
            'jumlah_biaya_servis' => [
                'required',
                'numeric',
                'min:0',
            ],
            'jenis_pembayaran' => [
                'nullable',
                Rule::in(['Cash / Tunai', 'Non Tunai']),
            ],
            'keterangan' => [
                'nullable',
                'string',
            ],
        ]);

        $pembayaran->update($validated);

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran service berhasil diperbarui.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()
            ->route('pembayaran.index')
            ->with('success', 'Pembayaran service berhasil dihapus.');
    }
}
