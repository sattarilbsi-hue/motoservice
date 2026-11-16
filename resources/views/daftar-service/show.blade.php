@extends('layouts.app')

@section('title', 'Detail Daftar Service')

@section('content')

<div class="page-header">

    <div>
        <div class="breadcrumb-text">
            Daftar Service / Detail
        </div>

        <h1>
            Detail Daftar Service
        </h1>

        <p>
            Informasi lengkap service pelanggan.
        </p>
    </div>

    <div class="header-actions">

        <a href="{{ route('daftar-service.edit', $daftarService->id) }}"
           class="btn btn-primary">

            <i class="bi bi-pencil-square"></i>
            Edit

        </a>

        <a href="{{ route('daftar-service.index') }}"
           class="btn btn-outline-dark">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

    </div>

</div>


<div class="detail-card">

    <div class="service-header">

        <div class="service-icon">
            <i class="bi bi-tools"></i>
        </div>

        <div>

            <span class="service-label">
                ID SERVIS PELANGGAN
            </span>

            <h2>
                {{ $daftarService->id_servis_pelanggan }}
            </h2>

            <span class="service-status">
                <i class="bi bi-check-circle-fill"></i>
                Terdaftar
            </span>

        </div>

    </div>


    <div class="divider"></div>


    <div class="row g-4">

        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-person"></i>
                </div>

                <div>

                    <span>
                        Id Pelanggan
                    </span>

                    <strong>
                        {{ $daftarService->pelanggan->id_pelanggan }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-person-check"></i>
                </div>

                <div>

                    <span>
                        Nama Pelanggan
                    </span>

                    <strong>
                        {{ $daftarService->pelanggan->nama_lengkap }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-md-6">

            <div class="info-box">

                <div class="info-icon">
                    <i class="bi bi-car-front"></i>
                </div>

                <div>

                    <span>
                        No Plat Kendaraan
                    </span>

                    <strong>
                        {{ $daftarService->kendaraan->no_plat }}
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
                        Tanggal Servis
                    </span>

                    <strong>
                        {{ $daftarService->tanggal_servis->format('d F Y') }}
                    </strong>

                </div>

            </div>

        </div>


        <div class="col-12">

            <div class="complaint-box">

                <div class="complaint-icon">
                    <i class="bi bi-chat-left-text"></i>
                </div>

                <div>

                    <span>
                        Keluhan Kendaraan
                    </span>

                    <p>
                        {{ $daftarService->keluhan_kendaraan }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


<div class="bottom-actions">

    <a href="{{ route('daftar-service.edit', $daftarService->id) }}"
       class="btn btn-primary">

        <i class="bi bi-pencil-square"></i>
        Edit Daftar Service

    </a>


    <form action="{{ route('daftar-service.destroy', $daftarService->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus daftar service ini?')">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">

            <i class="bi bi-trash3"></i>
            Hapus

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

    .service-header {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .service-icon {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
    }

    .service-label {
        color: #b28a72;
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .8px;
    }

    .service-header h2 {
        color: #4a2c20;
        font-weight: 800;
        margin: 4px 0 7px;
    }

    .service-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #47704c;
        background: #eef8ef;
        border-radius: 30px;
        padding: 6px 10px;
        font-size: .75rem;
        font-weight: 700;
    }

    .divider {
        height: 1px;
        background: #eee5df;
        margin: 28px 0;
    }

    .info-box,
    .complaint-box {
        border: 1px solid #eee5df;
        border-radius: 15px;
        background: #fffdfb;
        transition: all .2s ease;
    }

    .info-box {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 17px;
    }

    .info-box:hover,
    .complaint-box:hover {
        transform: translateY(-2px);
        border-color: #dbc4b4;
        box-shadow: 0 8px 25px rgba(74, 44, 32, .06);
    }

    .info-icon,
    .complaint-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-box span,
    .complaint-box span {
        display: block;
        color: #9b867a;
        font-size: .78rem;
        margin-bottom: 3px;
    }

    .info-box strong {
        color: #4a2c20;
        font-size: .96rem;
    }

    .complaint-box {
        display: flex;
        gap: 15px;
        padding: 20px;
    }

    .complaint-box p {
        color: #5f4b41;
        margin: 5px 0 0;
        line-height: 1.7;
    }

    .bottom-actions {
        display: flex;
        justify-content: flex-end;
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