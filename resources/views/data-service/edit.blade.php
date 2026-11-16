
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Edit Data Service</h3>
            <p class="text-muted mb-0">Perbarui informasi pengerjaan service kendaraan.</p>
        </div>

        <a href="{{ route('data-service.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form action="{{ route('data-service.update', $dataService->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('data-service._form')
            </form>
        </div>
    </div>
</div>
@endsection
