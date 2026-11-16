
@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <a href="{{ route('pembayaran.index') }}"
           class="text-decoration-none"
           style="color:#79543D;">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Pembayaran
        </a>

        <h3 class="fw-bold mt-3 mb-1" style="color:#4A2C20;">
            Detail Pembayaran Service
        </h3>

        <p style="color:#8B776B;">
            Informasi lengkap pembayaran service pelanggan.
        </p>
    </div>

    <div class="card border-0 shadow-sm"
         style="border-radius:18px; overflow:hidden;">

        <div class="card-header border-0 p-4"
             style="background:#F7F0E8;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="fw-bold mb-1" style="color:#4A2C20;">
                        <i class="bi bi-receipt me-2"></i>Informasi Pembayaran
                    </h5>
                    <small style="color:#8B776B;">
                        ID Servis:
                        {{ $pembayaran->daftarService->id_servis_pelanggan ?? '-' }}
                    </small>
                </div>

                <span class="badge rounded-pill px-3 py-2"
                      style="background:#E8D8C7; color:#4A2C20;">
                    Detail Transaksi
                </span>
            </div>
        </div>

        <div class="card-body p-4">

            <h6 class="fw-bold mb-3" style="color:#79543D;">
                Informasi Pelanggan dan Kendaraan
            </h6>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="p-3 rounded-3 h-100" style="background:#FAF7F2;">
                        <small style="color:#8B776B;">Nama Pelanggan</small>
                        <div class="fw-semibold mt-1" style="color:#4A2C20;">
                            {{ $pembayaran->daftarService->pelanggan->nama_lengkap ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 h-100" style="background:#FAF7F2;">
                        <small style="color:#8B776B;">Nomor Plat Kendaraan</small>
                        <div class="fw-semibold mt-1" style="color:#4A2C20;">
                            {{ $pembayaran->daftarService->kendaraan->no_plat ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-3" style="color:#79543D;">
                Rincian Pembayaran
            </h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-3 rounded-3 h-100" style="background:#FAF7F2;">
                        <small style="color:#8B776B;">ID Servis Pelanggan</small>
                        <div class="fw-semibold mt-1" style="color:#4A2C20;">
                            {{ $pembayaran->daftarService->id_servis_pelanggan ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 h-100" style="background:#FAF7F2;">
                        <small style="color:#8B776B;">Jumlah Biaya Servis</small>
                        <div class="fw-bold fs-5 mt-1" style="color:#79543D;">
                            Rp {{ number_format($pembayaran->jumlah_biaya_servis, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 h-100" style="background:#FAF7F2;">
                        <small style="color:#8B776B;">Jenis Pembayaran</small>
                        <div class="fw-semibold mt-1" style="color:#4A2C20;">
                            {{ $pembayaran->jenis_pembayaran ?? 'Belum dipilih' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-3 rounded-3 h-100" style="background:#FAF7F2;">
                        <small style="color:#8B776B;">Keterangan</small>
                        <div class="fw-semibold mt-1" style="color:#4A2C20;">
                            {{ $pembayaran->keterangan ?: '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('pembayaran.edit', $pembayaran->id) }}"
                   class="btn text-white px-4"
                   style="background:#79543D; border-radius:10px;">
                    <i class="bi bi-pencil-square me-1"></i>Edit
                </a>

                <a href="{{ route('pembayaran.index') }}"
                   class="btn px-4"
                   style="background:#F7F0E8; color:#79543D; border-radius:10px;">
                    Kembali
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
