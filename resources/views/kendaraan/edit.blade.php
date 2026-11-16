@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')

<div class="page-header">

    <div>
        <div class="breadcrumb-text">
            Data Kendaraan / Edit
        </div>

        <h1>
            Edit Kendaraan
        </h1>

        <p>
            Perbarui informasi kendaraan yang tersimpan.
        </p>
    </div>

    <a href="{{ route('kendaraan.index') }}" class="btn btn-outline-dark back-btn">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

</div>


<div class="form-card">

    <div class="form-card-header">

        <div class="icon-box">
            <i class="bi bi-pencil-square"></i>
        </div>

        <div>
            <h5>Edit Informasi Kendaraan</h5>

            <p>
                Perbarui data kendaraan dengan informasi terbaru.
            </p>
        </div>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle-fill"></i>
                Data belum dapat diperbarui.
            </div>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST">

        @csrf
        @method('PUT')

        @include('kendaraan._form')

    </form>

</div>


<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 28px;
        gap: 20px;
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

    .back-btn {
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        border-color: #d8c9be;
        color: #4a2c20;
        white-space: nowrap;
    }

    .form-card {
        background: #fff;
        border: 1px solid #eadfd7;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 35px rgba(74, 44, 32, .07);
        animation: fadeUp .45s ease;
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 28px;
        padding-bottom: 22px;
        border-bottom: 1px solid #eee5df;
    }

    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #fff4e8;
        color: #c68b59;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }

    .form-card-header h5 {
        margin: 0;
        color: #4a2c20;
        font-weight: 800;
    }

    .form-card-header p {
        margin: 4px 0 0;
        color: #917c70;
        font-size: .9rem;
    }

    .alert {
        border-radius: 12px;
        border: 0;
        margin-bottom: 24px;
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
            align-items: flex-start;
            flex-direction: column;
        }

        .back-btn {
            width: 100%;
        }

        .form-card {
            padding: 20px;
        }
    }
</style>

@endsection