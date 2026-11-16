
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Detail Data Service</h3>
            <p class="text-muted mb-0">Informasi lengkap pengerjaan kendaraan.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('data-service.edit', $dataService->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>

            <a href="{{ route('data-service.index') }}" class="btn btn-light">
                Kembali
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Informasi Service</h5>

            <div class="row g-4">
                <div class="col-md-6">
                    <small class="text-muted">ID Servis Pelanggan</small>
                    <h6 class="fw-bold mt-1">
                        {{ $dataService->daftarService->id_servis_pelanggan ?? '-' }}
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Nama Pelanggan</small>
                    <h6 class="fw-bold mt-1">
                        {{ $dataService->daftarService->pelanggan->nama_lengkap ?? '-' }}
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Nomor Plat Kendaraan</small>
                    <h6 class="fw-bold mt-1">
                        {{ $dataService->daftarService->kendaraan->no_plat ?? '-' }}
                    </h6>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Nama Mekanik</small>
                    <h6 class="fw-bold mt-1">{{ $dataService->nama_mekanik }}</h6>
                </div>

                <div class="col-12">
                    <small class="text-muted">Keluhan Kendaraan</small>
                    <p class="mt-1 mb-0">{{ $dataService->keluhan_kendaraan }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-muted">Estimasi Service</small>
                    <h5 class="fw-bold text-success mt-1">
                        Rp {{ number_format($dataService->estimasi_service, 0, ',', '.') }}
                    </h5>
                </div>

                <div class="col-12">
                    <small class="text-muted">Sparepart Pengganti</small>
                    <p class="mt-1 mb-0">
                        {{ $dataService->sparepart_pengganti ?: 'Tidak ada sparepart pengganti' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
