@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')

<div class="page-header">

    <div>

        <div class="page-kicker">
            DATA PELANGGAN
        </div>

        <h1 class="page-title">
            Detail Pelanggan
        </h1>

        <p class="page-subtitle">
            Informasi lengkap pelanggan yang tersimpan.
        </p>

    </div>

    <div class="d-flex gap-2">

        <a href="{{ route('pelanggan.index') }}"
           class="btn btn-outline-dark">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

        <a href="{{ route('pelanggan.edit', $pelanggan) }}"
           class="btn btn-primary-custom">

            <i class="bi bi-pencil"></i>

            Edit

        </a>

    </div>

</div>


<div class="row justify-content-center">

    <div class="col-xl-9">

        <div class="content-card">

            <div class="card-header-custom">

                <div class="d-flex align-items-center gap-3">

                    <div class="icon-box">

                        <i class="bi bi-person-vcard"></i>

                    </div>

                    <div>

                        <h5 class="mb-1">
                            {{ $pelanggan->nama_lengkap }}
                        </h5>

                        <p class="text-muted mb-0">

                            ID Pelanggan:
                            <strong>
                                {{ $pelanggan->id_pelanggan }}
                            </strong>

                        </p>

                    </div>

                </div>

            </div>


            <div class="card-body-custom">

                <div class="row g-4">

                    {{-- ID --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <span class="detail-label">
                                ID Pelanggan
                            </span>

                            <span class="detail-value">
                                {{ $pelanggan->id_pelanggan }}
                            </span>

                        </div>

                    </div>


                    {{-- Nama --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <span class="detail-label">
                                Nama Lengkap
                            </span>

                            <span class="detail-value">
                                {{ $pelanggan->nama_lengkap }}
                            </span>

                        </div>

                    </div>


                    {{-- No HP --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <span class="detail-label">
                                No HP
                            </span>

                            <span class="detail-value">
                                {{ $pelanggan->no_hp }}
                            </span>

                        </div>

                    </div>


                    {{-- Pekerjaan --}}
                    <div class="col-md-6">

                        <div class="detail-box">

                            <span class="detail-label">
                                Pekerjaan
                            </span>

                            <span class="detail-value">
                                {{ $pelanggan->pekerjaan }}
                            </span>

                        </div>

                    </div>


                    {{-- Alamat --}}
                    <div class="col-12">

                        <div class="detail-box">

                            <span class="detail-label">
                                Alamat Pelanggan
                            </span>

                            <span class="detail-value">
                                {{ $pelanggan->alamat }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Data service --}}
                @if($pelanggan->daftarServices->count() > 0)

                <div class="related-section">

                    <div class="section-title">

                        <i class="bi bi-wrench-adjustable"></i>

                        Riwayat Service

                    </div>

                    <p class="text-muted">
                        Pelanggan ini memiliki
                        {{ $pelanggan->daftarServices->count() }}
                        data service.
                    </p>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection