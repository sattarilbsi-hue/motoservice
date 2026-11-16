@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')

<div class="page-header">
    <div>
        <div class="page-kicker">DATA PELANGGAN</div>
        <h1 class="page-title">Edit Pelanggan</h1>
        <p class="page-subtitle">
            Perbarui informasi pelanggan yang dipilih.
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
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>
                        <h5 class="mb-1">Edit Data Pelanggan</h5>

                        <p class="text-muted mb-0">
                            ID Pelanggan:
                            <strong>{{ $pelanggan->id_pelanggan }}</strong>
                        </p>
                    </div>

                </div>
            </div>

            <div class="card-body-custom">

                <form action="{{ route('pelanggan.update', $pelanggan) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    @include('pelanggan._form')

                    <div class="form-actions">

                        <a href="{{ route('pelanggan.show', $pelanggan) }}"
                           class="btn btn-light border">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-save"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection