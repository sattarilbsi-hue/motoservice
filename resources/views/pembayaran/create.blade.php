
@extends('layouts.app')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="container-fluid py-4">

    <div class="mb-4">
        <a href="{{ route('pembayaran.index') }}"
           class="text-decoration-none"
           style="color:#79543D;">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Pembayaran
        </a>

        <h3 class="fw-bold mt-3 mb-1" style="color:#4A2C20;">
            Tambah Pembayaran Service
        </h3>

        <p style="color:#8B776B;">
            Masukkan informasi pembayaran service pelanggan.
        </p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm"
         style="border-radius:18px; overflow:hidden;">

        <div class="card-header border-0 p-4"
             style="background:#F7F0E8;">
            <h5 class="fw-bold mb-1" style="color:#4A2C20;">
                <i class="bi bi-receipt me-2"></i>Form Pembayaran
            </h5>
            <small style="color:#8B776B;">
                Kolom bertanda * wajib diisi.
            </small>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('pembayaran.store') }}" method="POST">
                @csrf

                @include('pembayaran._form')
            </form>
        </div>
    </div>

</div>
@endsection
