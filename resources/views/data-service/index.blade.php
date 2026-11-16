
@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <div class="text-muted small mb-1">
                <i class="bi bi-house-door me-1"></i> Dashboard / Data Service
            </div>
            <h3 class="fw-bold mb-1" style="color:#4A2C20;">Data Service</h3>
            <p class="mb-0" style="color:#8B776B;">
                Kelola pengerjaan dan estimasi service kendaraan.
            </p>
        </div>

        <a href="{{ route('data-service.create') }}"
           class="btn rounded-3 px-4 py-2"
           style="background:#4A2C20;color:#fff;">
            <i class="bi bi-plus-circle me-2"></i>Tambah Data Service
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert rounded-3 border-0 shadow-sm"
             style="background:#E8F1E8;color:#426344;">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert rounded-3 border-0 shadow-sm"
             style="background:#FCE8E6;color:#9B3830;">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert rounded-3 border-0 shadow-sm"
             style="background:#FCE8E6;color:#9B3830;">
            <strong>Periksa kembali data:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-6">
            <div class="card border-0 rounded-4 shadow-sm h-100"
                 style="background:#fff;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small mb-2" style="color:#8B776B;">
                                Total Data Service
                            </div>
                            <h3 class="fw-bold mb-0" style="color:#4A2C20;">
                                {{ $totalDataService }}
                            </h3>
                            <small style="color:#A18B7D;">Data pengerjaan tercatat</small>
                        </div>

                        <div class="rounded-4 p-3"
                             style="background:#F7F0E8;color:#A66B43;">
                            <i class="bi bi-tools fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 rounded-4 shadow-sm h-100"
                 style="background:#fff;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small mb-2" style="color:#8B776B;">
                                Total Estimasi Service
                            </div>
                            <h3 class="fw-bold mb-0" style="color:#4A2C20;">
                                Rp {{ number_format($totalEstimasi, 0, ',', '.') }}
                            </h3>
                            <small style="color:#A18B7D;">Akumulasi estimasi biaya</small>
                        </div>

                        <div class="rounded-4 p-3"
                             style="background:#F7F0E8;color:#A66B43;">
                            <i class="bi bi-cash-stack fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL --}}
    <div class="card border-0 rounded-4 shadow-sm">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                <div>
                    <h5 class="fw-bold mb-1" style="color:#4A2C20;">
                        Daftar Pengerjaan Service
                    </h5>
                    <small style="color:#8B776B;">
                        Informasi pengerjaan setiap kendaraan.
                    </small>
                </div>

                <span class="rounded-pill px-3 py-2 small fw-semibold"
                      style="background:#F7F0E8;color:#79543D;">
                    {{ $dataServices->total() }} Data
                </span>
            </div>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr style="background:#F7F3ED;color:#4A2C20;">
                            <th class="py-3">No</th>
                            <th class="py-3">ID Servis</th>
                            <th class="py-3">Pelanggan</th>
                            <th class="py-3">No. Plat</th>
                            <th class="py-3">Nama Mekanik</th>
                            <th class="py-3">Estimasi Service</th>
                            <th class="py-3">Sparepart</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($dataServices as $index => $data)
                            <tr>
                                <td>{{ $dataServices->firstItem() + $index }}</td>

                                <td class="fw-semibold" style="color:#4A2C20;">
                                    {{ $data->daftarService->id_servis_pelanggan ?? '-' }}
                                </td>

                                <td>
                                    {{ $data->daftarService->pelanggan->nama_lengkap ?? '-' }}
                                </td>

                                <td>
                                    <span class="rounded-2 px-2 py-1 small fw-semibold"
                                          style="background:#F7F0E8;color:#79543D;">
                                        {{ $data->daftarService->kendaraan->no_plat ?? '-' }}
                                    </span>
                                </td>

                                <td>{{ $data->nama_mekanik }}</td>

                                <td class="fw-semibold" style="color:#79543D;">
                                    Rp {{ number_format($data->estimasi_service, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $data->sparepart_pengganti ?: '-' }}
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('data-service.show', $data->id) }}"
                                           class="btn btn-sm rounded-2"
                                           style="background:#F7F0E8;color:#79543D;"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('data-service.edit', $data->id) }}"
                                           class="btn btn-sm rounded-2"
                                           style="background:#F5E8D9;color:#94623D;"
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('data-service.destroy', $data->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data service ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm rounded-2"
                                                    style="background:#FCE8E6;color:#B34B40;"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="bi bi-tools fs-1"
                                           style="color:#C68B59;"></i>
                                    </div>

                                    <h6 class="fw-bold" style="color:#4A2C20;">
                                        Belum Ada Data Service
                                    </h6>

                                    <p class="small mb-3" style="color:#8B776B;">
                                        Belum ada pengerjaan service yang tercatat.
                                    </p>

                                    <a href="{{ route('data-service.create') }}"
                                       class="btn rounded-3 px-3"
                                       style="background:#4A2C20;color:white;">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Tambah Data Service
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $dataServices->links() }}
            </div>

        </div>
    </div>

</div>
@endsection
