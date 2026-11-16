@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')

<div class="page-header">
    <div>
        <div class="page-kicker">DATA PELANGGAN</div>
        <h1 class="page-title">Tambah Pelanggan</h1>
        <p class="page-subtitle">
            Tambahkan data pelanggan baru ke sistem MotoService.
        </p>
    </div>

    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-dark">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-xl-9">

        <div class="content-card">

            <div class="card-header-custom">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-box">
                        <i class="bi bi-person-plus"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">Form Data Pelanggan</h5>
                        <p class="text-muted mb-0">
                            Lengkapi seluruh data pelanggan.
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body-custom">

                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf

                    @include('pelanggan._form')

                    <div class="form-actions">
                        <a href="{{ route('pelanggan.index') }}"
                           class="btn btn-light border">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-check2-circle"></i>
                            Simpan Pelanggan
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection