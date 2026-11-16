@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')

<style>
    .kendaraan-page {
        animation: fadeUp .45s ease;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 28px;
    }

    .page-label {
        color: #b07b52;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        margin-bottom: 8px;
    }

    .page-title-custom {
        color: #3d2a20;
        font-size: 30px;
        font-weight: 800;
        line-height: 1.2;
        margin: 0 0 8px;
    }

    .page-description {
        color: #91847b;
        font-size: 14px;
        line-height: 1.6;
        margin: 0;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;

        background: #6f4931;
        color: #fff !important;

        border: none;
        border-radius: 12px;

        padding: 12px 18px;

        font-size: 13px;
        font-weight: 700;

        text-decoration: none;

        box-shadow: 0 7px 20px rgba(111, 73, 49, .18);

        transition: all .25s ease;

        white-space: nowrap;
    }

    .btn-add:hover {
        background: #553622;
        color: #fff !important;
        transform: translateY(-2px);
    }

    .custom-alert {
        border: none;
        border-radius: 13px;
        padding: 14px 17px;
        font-size: 13px;
        margin-bottom: 22px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #eee8e2;
        border-radius: 16px;
        padding: 18px 20px;

        display: flex;
        align-items: center;
        gap: 15px;

        box-shadow: 0 5px 25px rgba(62, 42, 28, .035);

        transition: all .25s ease;
    }

    .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(62, 42, 28, .08);
    }

    .summary-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;

        border-radius: 13px;

        background: #f5ebe2;
        color: #765038;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;
    }

    .summary-info small {
        display: block;
        color: #998d84;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .summary-info strong {
        display: block;
        color: #3f2c21;
        font-size: 20px;
        font-weight: 800;
        line-height: 1;
    }

    .main-card {
        background: #fff;
        border: 1px solid #eee8e2;
        border-radius: 18px;
        overflow: hidden;

        box-shadow: 0 7px 30px rgba(62, 42, 28, .045);
    }

    .main-card-header {
        padding: 21px 24px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        border-bottom: 1px solid #f0ebe6;
    }

    .card-heading {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .card-icon {
        width: 43px;
        height: 43px;

        border-radius: 12px;

        background: #f5ebe2;
        color: #704a32;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
    }

    .card-heading h5 {
        color: #3f2c21;
        font-size: 15px;
        font-weight: 800;
        margin: 0 0 4px;
    }

    .card-heading p {
        color: #998d84;
        font-size: 12px;
        margin: 0;
    }

    .total-badge {
        background: #f7f0e9;
        color: #765038;

        border-radius: 50px;

        padding: 7px 12px;

        font-size: 11px;
        font-weight: 800;

        white-space: nowrap;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .vehicle-table {
        width: 100%;
        min-width: 1000px;
        margin: 0;
        border-collapse: collapse;
    }

    .vehicle-table thead th {
        background: #faf8f5;

        color: #88776b;

        font-size: 10px;
        font-weight: 800;

        letter-spacing: .7px;
        text-transform: uppercase;

        padding: 15px 17px;

        border-bottom: 1px solid #eee8e2;

        white-space: nowrap;
    }

    .vehicle-table tbody td {
        padding: 17px;

        color: #64574e;

        font-size: 13px;

        border-bottom: 1px solid #f2eee9;

        vertical-align: middle;
    }

    .vehicle-table tbody tr {
        transition: background .2s ease;
    }

    .vehicle-table tbody tr:hover {
        background: #fdfbf9;
    }

    .vehicle-table tbody tr:last-child td {
        border-bottom: none;
    }

    .number-cell {
        color: #a2968d;
        font-size: 12px;
        font-weight: 700;
    }

    .plate-badge {
        display: inline-block;

        background: #3f3027;
        color: #fff;

        padding: 7px 11px;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 800;

        letter-spacing: .5px;

        white-space: nowrap;
    }

    .vehicle-type {
        display: inline-flex;
        align-items: center;
        gap: 7px;

        background: #f5ebe2;
        color: #765038;

        padding: 7px 10px;

        border-radius: 8px;

        font-size: 11px;
        font-weight: 700;

        white-space: nowrap;
    }

    .stnk-text {
        font-size: 12px;
        font-weight: 600;
        color: #64574e;
        white-space: nowrap;
    }

    .owner-name {
        color: #3f3027;
        font-weight: 700;
        white-space: nowrap;
    }

    .year-badge {
        background: #f7f5f2;
        border: 1px solid #ece7e2;
        color: #71665f;

        padding: 6px 9px;

        border-radius: 7px;

        font-size: 11px;
        font-weight: 700;
    }

    .color-text {
        white-space: nowrap;
    }

    .action-group {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .action-form {
        margin: 0;
    }

    .action-button {
        width: 34px;
        height: 34px;

        border: none;
        border-radius: 9px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        font-size: 13px;

        transition: all .2s ease;
    }

    .action-button:hover {
        transform: translateY(-2px);
    }

    .btn-view {
        background: #eaf2f5;
        color: #44778b;
    }

    .btn-edit {
        background: #fff2dd;
        color: #b17a28;
    }

    .btn-delete {
        background: #fce9e7;
        color: #c35149;
    }

    .empty-state {
        padding: 65px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 76px;
        height: 76px;

        margin: 0 auto 18px;

        border-radius: 22px;

        background: #f5ebe2;
        color: #765038;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 30px;
    }

    .empty-state h5 {
        color: #3f3027;
        font-size: 17px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #998d84;
        font-size: 13px;
        margin-bottom: 20px;
    }

    @media (max-width: 900px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .page-top {
            flex-direction: column;
        }

        .btn-add {
            width: 100%;
        }
    }
</style>


<div class="kendaraan-page">

    {{-- HEADER --}}
    <div class="page-top">

        <div>

            <div class="page-label">
                MASTER DATA
            </div>

            <h1 class="page-title-custom">
                Data Kendaraan
            </h1>

            <p class="page-description">
                Kelola informasi kendaraan pelanggan yang menggunakan layanan MotoService.
            </p>

        </div>


        <a href="{{ route('kendaraan.create') }}"
           class="btn-add">

            <i class="bi bi-plus-circle-fill"></i>

            Tambah Kendaraan

        </a>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show custom-alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ALERT ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show custom-alert">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- SUMMARY --}}
    <div class="summary-grid">

        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-bicycle"></i>
            </div>

            <div class="summary-info">

                <small>
                    Total Kendaraan
                </small>

                <strong>
                    {{ $kendaraans->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-speedometer2"></i>
            </div>

            <div class="summary-info">

                <small>
                    Kendaraan Terdaftar
                </small>

                <strong>
                    {{ $kendaraans->count() }}
                </strong>

            </div>

        </div>


        <div class="summary-card">

            <div class="summary-icon">
                <i class="bi bi-wrench-adjustable"></i>
            </div>

            <div class="summary-info">

                <small>
                    Data Kendaraan
                </small>

                <strong>
                    {{ $kendaraans->count() }}
                </strong>

            </div>

        </div>

    </div>


    {{-- MAIN CARD --}}
    <div class="main-card">

        <div class="main-card-header">

            <div class="card-heading">

                <div class="card-icon">
                    <i class="bi bi-motorcycle"></i>
                </div>

                <div>

                    <h5>
                        Daftar Kendaraan
                    </h5>

                    <p>
                        Informasi kendaraan pelanggan MotoService
                    </p>

                </div>

            </div>


            <div class="total-badge">

                <i class="bi bi-database-fill me-1"></i>

                {{ $kendaraans->count() }} Data

            </div>

        </div>


        @if($kendaraans->count() > 0)

            <div class="table-wrapper">

                <table class="vehicle-table">

                    <thead>

                        <tr>

                            <th style="width: 55px;">
                                No
                            </th>

                            <th>
                                No Plat
                            </th>

                            <th>
                                Jenis Kendaraan
                            </th>

                            <th>
                                No STNK
                            </th>

                            <th>
                                Tahun
                            </th>

                            <th>
                                Nama Pemilik
                            </th>

                            <th>
                                Warna
                            </th>

                            <th style="width: 130px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($kendaraans as $kendaraan)

                            <tr>

                                <td class="number-cell">
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <span class="plate-badge">
                                        {{ $kendaraan->no_plat }}
                                    </span>

                                </td>


                                <td>

                                    <span class="vehicle-type">

                                        @if($kendaraan->jenis_kendaraan === 'Matic')

                                            <i class="bi bi-gear-fill"></i>

                                        @else

                                            <i class="bi bi-gear-wide-connected"></i>

                                        @endif

                                        {{ $kendaraan->jenis_kendaraan }}

                                    </span>

                                </td>


                                <td>

                                    <span class="stnk-text">
                                        {{ $kendaraan->no_stnk }}
                                    </span>

                                </td>


                                <td>

                                    <span class="year-badge">
                                        {{ $kendaraan->tahun_pembuatan }}
                                    </span>

                                </td>


                                <td>

                                    <span class="owner-name">
                                        {{ $kendaraan->nama_pemilik }}
                                    </span>

                                </td>


                                <td>

                                    <span class="color-text">
                                        {{ $kendaraan->warna_kendaraan }}
                                    </span>

                                </td>


                                <td>

                                    <div class="action-group">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('kendaraan.show', $kendaraan) }}"
                                           class="action-button btn-view"
                                           title="Detail">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('kendaraan.edit', $kendaraan) }}"
                                           class="action-button btn-edit"
                                           title="Edit">

                                            <i class="bi bi-pencil-fill"></i>

                                        </a>


                                        {{-- HAPUS --}}
                                        <form action="{{ route('kendaraan.destroy', $kendaraan) }}"
                                              method="POST"
                                              class="action-form"
                                              onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="action-button btn-delete"
                                                    title="Hapus">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bi bi-motorcycle"></i>
                </div>

                <h5>
                    Belum Ada Data Kendaraan
                </h5>

                <p>
                    Belum ada kendaraan yang tersimpan di dalam sistem.
                </p>

                <a href="{{ route('kendaraan.create') }}"
                   class="btn-add">

                    <i class="bi bi-plus-circle-fill"></i>

                    Tambah Kendaraan

                </a>

            </div>

        @endif

    </div>

</div>

@endsection