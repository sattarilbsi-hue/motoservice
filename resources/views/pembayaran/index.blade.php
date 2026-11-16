
@extends('layouts.app')

@section('title', 'Pembayaran Service')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1" style="color:#4A2C20;">
                Pembayaran Service
            </h3>
            <p class="mb-0" style="color:#8B776B;">
                Kelola data pembayaran pelanggan service motor.
            </p>
        </div>

        <a href="{{ route('pembayaran.create') }}"
           class="btn text-white px-4 py-2"
           style="background:#79543D; border-radius:12px;">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah Pembayaran
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100"
                 style="border-radius:18px; background:#fff;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3"
                         style="background:#F7F0E8; color:#79543D;">
                        <i class="bi bi-receipt fs-3"></i>
                    </div>
                    <div>
                        <div class="small" style="color:#8B776B;">Total Transaksi</div>
                        <h4 class="fw-bold mb-0" style="color:#4A2C20;">
                            {{ $totalPembayaran }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100"
                 style="border-radius:18px; background:#fff;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3"
                         style="background:#F7F0E8; color:#79543D;">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>
                    <div>
                        <div class="small" style="color:#8B776B;">Total Biaya Pembayaran</div>
                        <h4 class="fw-bold mb-0" style="color:#4A2C20;">
                            Rp {{ number_format($totalBiaya, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <div class="card border-0 shadow-sm"
         style="border-radius:18px; overflow:hidden; background:#fff;">

        <div class="card-header border-0 px-4 py-3"
             style="background:#F7F0E8;">
            <h5 class="fw-bold mb-0" style="color:#4A2C20;">
                <i class="bi bi-cash-stack me-2"></i>
                Daftar Pembayaran
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead style="background:#FAF7F2; color:#79543D;">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th class="py-3">ID Servis</th>
                            <th class="py-3">Nama Pelanggan</th>
                            <th class="py-3">No. Plat</th>
                            <th class="py-3">Jumlah Biaya</th>
                            <th class="py-3">Jenis Pembayaran</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pembayarans as $index => $pembayaran)
                            <tr>
                                <td class="px-4">
                                    {{ $pembayarans->firstItem() + $index }}
                                </td>

                                <td>
                                    <span class="fw-semibold" style="color:#79543D;">
                                        {{ $pembayaran->daftarService->id_servis_pelanggan ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $pembayaran->daftarService->pelanggan->nama_lengkap ?? '-' }}
                                </td>

                                <td>
                                    {{ $pembayaran->daftarService->kendaraan->no_plat ?? '-' }}
                                </td>

                                <td class="fw-semibold" style="color:#4A2C20;">
                                    Rp {{ number_format($pembayaran->jumlah_biaya_servis, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($pembayaran->jenis_pembayaran)
                                        <span class="badge rounded-pill px-3 py-2"
                                              style="background:#F7F0E8; color:#79543D;">
                                            {{ $pembayaran->jenis_pembayaran }}
                                        </span>
                                    @else
                                        <span style="color:#8B776B;">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('pembayaran.show', $pembayaran->id) }}"
                                           class="btn btn-sm"
                                           title="Detail"
                                           style="background:#F7F0E8; color:#79543D; border-radius:8px;">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                                           class="btn btn-sm"
                                           title="Edit"
                                           style="background:#F7F0E8; color:#79543D; border-radius:8px;">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm"
                                                    title="Hapus"
                                                    style="background:#FCEEEE; color:#B54747; border-radius:8px;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-receipt display-5 d-block mb-3"
                                       style="color:#C68B59;"></i>
                                    <h6 class="fw-bold" style="color:#4A2C20;">
                                        Belum ada data pembayaran
                                    </h6>
                                    <p class="mb-3" style="color:#8B776B;">
                                        Silakan tambahkan pembayaran service terlebih dahulu.
                                    </p>
                                    <a href="{{ route('pembayaran.create') }}"
                                       class="btn text-white"
                                       style="background:#79543D; border-radius:10px;">
                                        Tambah Pembayaran
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($pembayarans->hasPages())
            <div class="card-footer border-0 px-4 py-3"
                 style="background:#fff;">
                {{ $pembayarans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
