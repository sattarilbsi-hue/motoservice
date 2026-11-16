@extends('layouts.app')

@section('title', 'Daftar Service')

@section('content')

<div class="page-header">

    <div>
        <div class="breadcrumb-text">
            Service / Daftar Service
        </div>

        <h1>
            Daftar Service
        </h1>

        <p>
            Kelola data pendaftaran service pelanggan.
        </p>
    </div>

    <a href="{{ route('daftar-service.create') }}"
       class="btn btn-primary add-btn">

        <i class="bi bi-plus-lg"></i>
        Tambah Service

    </a>

</div>


@if(session('success'))

    <div class="alert alert-success custom-alert">

        <i class="bi bi-check-circle-fill"></i>

        <span>
            {{ session('success') }}
        </span>

    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger custom-alert">

        <i class="bi bi-exclamation-triangle-fill"></i>

        <span>
            {{ session('error') }}
        </span>

    </div>

@endif


{{-- Statistik --}}
<div class="row g-3 mb-4">

    <div class="col-md-4">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-tools"></i>
            </div>

            <div>

                <span>Total Service</span>

                <strong>
                    {{ $daftarServices->total() }}
                </strong>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-calendar-check"></i>
            </div>

            <div>

                <span>Hari Ini</span>

                <strong>
                    {{ $daftarServices->where('tanggal_servis', today())->count() }}
                </strong>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-person-check"></i>
            </div>

            <div>

                <span>Pelanggan</span>

                <strong>
                    {{ $pelangganCount }}
                </strong>

            </div>

        </div>

    </div>

</div>


<div class="table-card">

    <div class="table-card-header">

        <div>

            <h5>
                Data Pendaftaran Service
            </h5>

            <p>
                Daftar kendaraan yang masuk untuk melakukan service.
            </p>

        </div>

        <div class="total-badge">
            {{ $daftarServices->total() }} Data
        </div>

    </div>


    <div class="table-responsive">

        <table class="table custom-table align-middle">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Id Servis</th>
                    <th>No Plat</th>
                    <th>Id Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Keluhan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($daftarServices as $index => $service)

                    <tr>

                        <td>
                            {{ $daftarServices->firstItem() + $index }}
                        </td>

                        <td>
                            <span class="service-id">
                                {{ $service->id_servis_pelanggan }}
                            </span>
                        </td>

                        <td>
                            <span class="plate-badge">
                                {{ $service->kendaraan->no_plat }}
                            </span>
                        </td>

                        <td>
                            {{ $service->pelanggan->id_pelanggan }}
                        </td>

                        <td>

                            <div class="customer-name">

                                <div class="customer-avatar">
                                    {{ strtoupper(substr($service->pelanggan->nama_lengkap, 0, 1)) }}
                                </div>

                                <span>
                                    {{ $service->pelanggan->nama_lengkap }}
                                </span>

                            </div>

                        </td>

                        <td>

                            <div class="complaint-text">
                                {{ \Illuminate\Support\Str::limit($service->keluhan_kendaraan, 40) }}
                            </div>

                        </td>

                        <td>

                            <span class="date-badge">
                                <i class="bi bi-calendar3"></i>
                                {{ $service->tanggal_servis->format('d/m/Y') }}
                            </span>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a href="{{ route('daftar-service.show', $service->id) }}"
                                   class="action-btn detail"
                                   title="Detail">

                                    <i class="bi bi-eye"></i>

                                </a>


                                <a href="{{ route('daftar-service.edit', $service->id) }}"
                                   class="action-btn edit"
                                   title="Edit">

                                    <i class="bi bi-pencil"></i>

                                </a>


                                <form
                                    action="{{ route('daftar-service.destroy', $service->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus daftar service ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-btn delete"
                                        title="Hapus"
                                    >

                                        <i class="bi bi-trash3"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    <i class="bi bi-tools"></i>
                                </div>

                                <h5>
                                    Belum ada daftar service
                                </h5>

                                <p>
                                    Tambahkan pendaftaran service pertama untuk memulai.
                                </p>

                                <a href="{{ route('daftar-service.create') }}"
                                   class="btn btn-primary">

                                    <i class="bi bi-plus-lg"></i>
                                    Tambah Service

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    @if($daftarServices->hasPages())

        <div class="pagination-wrapper">

            {{ $daftarServices->links() }}

        </div>

    @endif

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

    .add-btn {
        background: #4a2c20;
        border-color: #4a2c20;
        border-radius: 10px;
        padding: 11px 18px;
        font-weight: 700;
        white-space: nowrap;
    }

    .add-btn:hover {
        background: #6b4030;
        border-color: #6b4030;
        transform: translateY(-1px);
    }

    .custom-alert {
        border: 0;
        border-radius: 12px;
        padding: 14px 17px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stat-card {
        background: #fff;
        border: 1px solid #eadfd7;
        border-radius: 16px;
        padding: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 8px 25px rgba(74, 44, 32, .05);
        transition: all .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 35px rgba(74, 44, 32, .08);
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 13px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .stat-card span {
        display: block;
        color: #9b867a;
        font-size: .78rem;
        margin-bottom: 3px;
    }

    .stat-card strong {
        display: block;
        color: #4a2c20;
        font-size: 1.25rem;
        font-weight: 800;
    }

    .table-card {
        background: #fff;
        border: 1px solid #eadfd7;
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(74, 44, 32, .06);
        overflow: hidden;
    }

    .table-card-header {
        padding: 22px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid #eee5df;
    }

    .table-card-header h5 {
        color: #4a2c20;
        font-weight: 800;
        margin: 0;
    }

    .table-card-header p {
        color: #917c70;
        font-size: .85rem;
        margin: 5px 0 0;
    }

    .total-badge {
        background: #fff4e8;
        color: #8b5d32;
        border-radius: 30px;
        padding: 7px 12px;
        font-size: .78rem;
        font-weight: 800;
        white-space: nowrap;
    }

    .custom-table {
        margin: 0;
        min-width: 1100px;
    }

    .custom-table thead th {
        background: #fcf9f6;
        color: #8b7467;
        border-bottom: 1px solid #eadfd7;
        font-size: .74rem;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px 18px;
        white-space: nowrap;
    }

    .custom-table tbody td {
        padding: 16px 18px;
        color: #5f4b41;
        border-bottom: 1px solid #f1e9e4;
        vertical-align: middle;
    }

    .custom-table tbody tr {
        transition: background .2s ease;
    }

    .custom-table tbody tr:hover {
        background: #fffaf6;
    }

    .service-id {
        color: #4a2c20;
        font-weight: 800;
    }

    .plate-badge {
        display: inline-block;
        background: #f1ece9;
        color: #4a2c20;
        border-radius: 7px;
        padding: 6px 9px;
        font-size: .76rem;
        font-weight: 800;
    }

    .customer-name {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 170px;
    }

    .customer-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #fff0e1;
        color: #a96f3e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .72rem;
        font-weight: 800;
        flex-shrink: 0;
    }

    .customer-name span {
        color: #4a2c20;
        font-weight: 700;
    }

    .complaint-text {
        max-width: 220px;
        color: #756258;
        line-height: 1.4;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #7c665b;
        font-size: .8rem;
        white-space: nowrap;
    }

    .date-badge i {
        color: #c68b59;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .action-buttons form {
        margin: 0;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        text-decoration: none;
        transition: all .2s ease;
    }

    .action-btn.detail {
        color: #496b86;
        background: #eef6fc;
    }

    .action-btn.edit {
        color: #9a6a32;
        background: #fff5e8;
    }

    .action-btn.delete {
        color: #a24e4e;
        background: #fff0f0;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 55px 20px;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        border-radius: 18px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .empty-state h5 {
        color: #4a2c20;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .empty-state p {
        color: #917c70;
        margin-bottom: 18px;
    }

    .empty-state .btn {
        background: #4a2c20;
        border-color: #4a2c20;
        border-radius: 10px;
        font-weight: 700;
    }

    .pagination-wrapper {
        padding: 18px 24px;
        border-top: 1px solid #eee5df;
    }

    @media (max-width: 768px) {

        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .add-btn {
            width: 100%;
        }

        .table-card-header {
            align-items: flex-start;
        }

    }

</style>

@endsection