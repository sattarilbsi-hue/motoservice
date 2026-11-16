@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

<div class="page-header fade-up">
    <div>
        <h1>Dashboard</h1>
        <p>Selamat datang di sistem manajemen service motor.</p>
    </div>
</div>

<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">
        <div class="stat-card fade-up delay-1">

            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-number">
                {{ \App\Models\Pelanggan::count() }}
            </div>

            <div class="stat-label">
                Total Pelanggan
            </div>

        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card fade-up delay-2">

            <div class="stat-icon">
                <i class="bi bi-scooter"></i>
            </div>

            <div class="stat-number">
                {{ \App\Models\Kendaraan::count() }}
            </div>

            <div class="stat-label">
                Total Kendaraan
            </div>

        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card fade-up delay-3">

            <div class="stat-icon">
                <i class="bi bi-tools"></i>
            </div>

            <div class="stat-number">
                {{ \App\Models\DaftarService::count() }}
            </div>

            <div class="stat-label">
                Total Service
            </div>

        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card fade-up delay-4">

            <div class="stat-icon">
                <i class="bi bi-credit-card-fill"></i>
            </div>

            <div class="stat-number">
                {{ \App\Models\Pembayaran::count() }}
            </div>

            <div class="stat-label">
                Total Pembayaran
            </div>

        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-lg-7">

        <div class="table-card fade-up delay-2">

            <div class="table-card-header">
                <div>
                    <h5>Alur Sistem Service</h5>
                    <small class="text-muted">
                        Proses pengelolaan service motor
                    </small>
                </div>
            </div>

            <div class="p-4">

                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>

                    <div>
                        <strong class="d-block" style="font-size:12px;">
                            Data Pelanggan
                        </strong>

                        <span class="text-muted" style="font-size:10px;">
                            Simpan data pelanggan.
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-scooter"></i>
                    </div>

                    <div>
                        <strong class="d-block" style="font-size:12px;">
                            Data Kendaraan
                        </strong>

                        <span class="text-muted" style="font-size:10px;">
                            Simpan data kendaraan pelanggan.
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-tools"></i>
                    </div>

                    <div>
                        <strong class="d-block" style="font-size:12px;">
                            Daftar Service
                        </strong>

                        <span class="text-muted" style="font-size:10px;">
                            Catat keluhan dan tanggal service.
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="stat-icon">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>

                    <div>
                        <strong class="d-block" style="font-size:12px;">
                            Data Service
                        </strong>

                        <span class="text-muted" style="font-size:10px;">
                            Catat mekanik dan sparepart.
                        </span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon">
                        <i class="bi bi-credit-card-fill"></i>
                    </div>

                    <div>
                        <strong class="d-block" style="font-size:12px;">
                            Pembayaran
                        </strong>

                        <span class="text-muted" style="font-size:10px;">
                            Catat pembayaran service.
                        </span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-5">

        <div class="table-card fade-up delay-3">

            <div class="table-card-header">
                <div>
                    <h5>Menu Cepat</h5>
                    <small class="text-muted">
                        Akses fitur utama
                    </small>
                </div>
            </div>

            <div class="p-4">

                <a href="{{ route('pelanggan.create') }}"
                   class="btn btn-main w-100 mb-3">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    Tambah Pelanggan
                </a>

                <a href="{{ route('kendaraan.create') }}"
                   class="btn btn-main w-100 mb-3">
                    <i class="bi bi-scooter me-2"></i>
                    Tambah Kendaraan
                </a>

                <a href="{{ route('daftar-service.create') }}"
                   class="btn btn-main w-100">
                    <i class="bi bi-tools me-2"></i>
                    Buat Daftar Service
                </a>

            </div>

        </div>

    </div>

</div>

@endsection