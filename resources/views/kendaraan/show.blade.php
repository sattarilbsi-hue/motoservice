@extends('layouts.app')

@section('title', 'Detail Kendaraan')

@section('content')

<div class="page-header">

    <div>
        <div class="breadcrumb-text">
            Data Kendaraan / Detail
        </div>

        <h1>
            Detail Kendaraan
        </h1>

        <p>
            Informasi lengkap kendaraan yang terdaftar.
        </p>
    </div>

    <div class="header-actions">

        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
           class="btn btn-primary">

            <i class="bi bi-pencil-square"></i>
            Edit Kendaraan

        </a>

        <a href="{{ route('kendaraan.index') }}"
           class="btn btn-outline-dark">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

</div>


<div class="detail-card">

    <div class="profile-section">

        <div class="vehicle-icon">
            <i class="bi bi-scooter"></i>
        </div>

        <div>

            <span class="status-label">
                KENDARAAN TERDAFTAR
            </span>

            <h2>
                {{ $kendaraan->no_plat }}
            </h2>

            <div class="vehicle-type">

                @if ($kendaraan->jenis_kendaraan === 'Matic')

                    <span class="badge-matic">
                        <i class="bi bi-scooter"></i>
                        Matic
                    </span>

                @else

                    <span class="badge-manual">
                        <i class="bi bi-bicycle"></i>
                        Manual Transimisi
                    </span>

                @endif

            </div>

        </div>

    </div>


    <div class="divider"></div>


    <div class="row g-4">

        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-card-text"></i>
                </div>

                <div>

                    <span>
                        No Plat Kendaraan
                    </span>

                    <strong>
                        {{ $kendaraan->no_plat }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-credit-card-2-front"></i>
                </div>

                <div>

                    <span>
                        No STNK
                    </span>

                    <strong>
                        {{ $kendaraan->no_stnk }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div>

                    <span>
                        Tahun Pembuatan
                    </span>

                    <strong>
                        {{ $kendaraan->tahun_pembuatan }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-person"></i>
                </div>

                <div>

                    <span>
                        Nama Pemilik
                    </span>

                    <strong>
                        {{ $kendaraan->nama_pemilik }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-palette"></i>
                </div>

                <div>

                    <span>
                        Warna Kendaraan
                    </span>

                    <strong>
                        {{ $kendaraan->warna_kendaraan }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div>

                    <span>
                        Terdaftar
                    </span>

                    <strong>
                        {{ $kendaraan->created_at->format('d F Y, H:i') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="bottom-actions">

    <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
       class="btn btn-primary">

        <i class="bi bi-pencil-square"></i>
        Edit Data Kendaraan

    </a>


    <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">

            <i class="bi bi-trash3"></i>
            Hapus Kendaraan

        </button>

    </form>

</div>


<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 28px;
    }

    .breadcrumb-text {
        color: #a07c68;
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .page-header h1 {
        color: #4a2c20;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .page-header p {
        color: #8c776b;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .header-actions .btn,
    .bottom-actions .btn {
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 600;
    }

    .btn-primary {
        background: #4a2c20;
        border-color: #4a2c20;
    }

    .btn-primary:hover {
        background: #6b4030;
        border-color: #6b4030;
        transform: translateY(-1px);
    }

    .detail-card {
        background: #fff;
        border: 1px solid #eadfd7;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 35px rgba(74, 44, 32, .07);
        animation: fadeUp .45s ease;
    }

    .profile-section {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .vehicle-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }

    .status-label {
        color: #b28a72;
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .profile-section h2 {
        color: #4a2c20;
        font-weight: 800;
        margin: 4px 0 8px;
    }

    .vehicle-type {
        display: flex;
    }

    .badge-matic,
    .badge-manual {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 30px;
        padding: 7px 12px;
        font-size: .78rem;
        font-weight: 700;
    }

    .badge-matic {
        color: #8b5d32;
        background: #fff1dc;
    }

    .badge-manual {
        color: #4a2c20;
        background: #f0e8e3;
    }

    .divider {
        height: 1px;
        background: #eee5df;
        margin: 28px 0;
    }

    .info-box {
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid #eee5df;
        border-radius: 15px;
        padding: 17px;
        background: #fffdfb;
        transition: all .2s ease;
    }

    .info-box:hover {
        transform: translateY(-2px);
        border-color: #dbc4b4;
        box-shadow: 0 8px 25px rgba(74, 44, 32, .06);
    }

    .info-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .info-box span {
        display: block;
        color: #9b867a;
        font-size: .78rem;
        margin-bottom: 3px;
    }

    .info-box strong {
        display: block;
        color: #4a2c20;
        font-size: .96rem;
    }

    .bottom-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-top: 22px;
    }

    .btn-danger {
        border-radius: 10px;
        font-weight: 600;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .header-actions {
            width: 100%;
            flex-direction: column;
        }

        .header-actions .btn {
            width: 100%;
        }

        .profile-section {
            align-items: flex-start;
        }

        .detail-card {
            padding: 20px;
        }

        .bottom-actions {
            flex-direction: column;
        }

        .bottom-actions form,
        .bottom-actions .btn {
            width: 100%;
        }

    }

</style>

@endsection