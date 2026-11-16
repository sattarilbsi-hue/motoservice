@csrf

<div class="row g-4">

    {{-- ID Servis Pelanggan --}}
    <div class="col-md-6">
        <label class="form-label">
            Id Servis Pelanggan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="id_servis_pelanggan"
            value="{{ old('id_servis_pelanggan', $daftarService->id_servis_pelanggan ?? '') }}"
            class="form-control @error('id_servis_pelanggan') is-invalid @enderror"
            placeholder="Contoh: SRV001"
            required
        >

        @error('id_servis_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- No Plat Kendaraan --}}
    <div class="col-md-6">
        <label class="form-label">
            No Plat Kendaraan <span class="text-danger">*</span>
        </label>

        <select
            name="kendaraan_id"
            id="kendaraan_id"
            class="form-select @error('kendaraan_id') is-invalid @enderror"
            required
        >

            <option value="">
                -- Pilih No Plat Kendaraan --
            </option>

            @foreach ($kendaraans as $kendaraan)

                <option
                    value="{{ $kendaraan->id }}"
                    {{ old('kendaraan_id', $daftarService->kendaraan_id ?? '') == $kendaraan->id ? 'selected' : '' }}
                >
                    {{ $kendaraan->no_plat }}
                    - {{ $kendaraan->nama_pemilik }}
                </option>

            @endforeach

        </select>

        @error('kendaraan_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- ID Pelanggan --}}
    <div class="col-md-6">
        <label class="form-label">
            Id Pelanggan <span class="text-danger">*</span>
        </label>

        <select
            name="pelanggan_id"
            id="pelanggan_id"
            class="form-select @error('pelanggan_id') is-invalid @enderror"
            required
        >

            <option value="">
                -- Pilih Id Pelanggan --
            </option>

            @foreach ($pelanggans as $pelanggan)

                <option
                    value="{{ $pelanggan->id }}"
                    data-nama="{{ $pelanggan->nama_lengkap }}"
                    {{ old('pelanggan_id', $daftarService->pelanggan_id ?? '') == $pelanggan->id ? 'selected' : '' }}
                >
                    {{ $pelanggan->id_pelanggan }}
                    - {{ $pelanggan->nama_lengkap }}
                </option>

            @endforeach

        </select>

        @error('pelanggan_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Nama Pelanggan Otomatis --}}
    <div class="col-md-6">
        <label class="form-label">
            Nama Pelanggan
        </label>

        <div class="auto-field">

            <div class="auto-icon">
                <i class="bi bi-person-check"></i>
            </div>

            <input
                type="text"
                id="nama_pelanggan"
                class="form-control"
                placeholder="Nama pelanggan akan muncul otomatis"
                value="{{ old('pelanggan_id', $daftarService->pelanggan_id ?? '') && isset($daftarService->pelanggan) ? $daftarService->pelanggan->nama_lengkap : '' }}"
                readonly
            >

        </div>

        <small class="text-muted">
            Nama pelanggan otomatis mengikuti Id Pelanggan yang dipilih.
        </small>
    </div>


    {{-- Keluhan --}}
    <div class="col-12">
        <label class="form-label">
            Keluhan Kendaraan <span class="text-danger">*</span>
        </label>

        <textarea
            name="keluhan_kendaraan"
            rows="4"
            class="form-control @error('keluhan_kendaraan') is-invalid @enderror"
            placeholder="Tuliskan keluhan kendaraan..."
            required
        >{{ old('keluhan_kendaraan', $daftarService->keluhan_kendaraan ?? '') }}</textarea>

        @error('keluhan_kendaraan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Tanggal Service --}}
    <div class="col-md-6">
        <label class="form-label">
            Tanggal Servis <span class="text-danger">*</span>
        </label>

        <input
            type="date"
            name="tanggal_servis"
            value="{{ old('tanggal_servis', isset($daftarService) && $daftarService->tanggal_servis ? $daftarService->tanggal_servis->format('Y-m-d') : date('Y-m-d')) }}"
            class="form-control @error('tanggal_servis') is-invalid @enderror"
            required
        >

        @error('tanggal_servis')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="form-footer mt-4">

    <a href="{{ route('daftar-service.index') }}" class="btn btn-light btn-cancel">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

    <button type="submit" class="btn btn-primary btn-save">
        <i class="bi bi-check-circle"></i>

        {{ isset($daftarService) ? 'Simpan Perubahan' : 'Simpan Daftar Service' }}
    </button>

</div>


<style>

    .form-label {
        font-weight: 700;
        color: #4a2c20;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border: 1px solid #e4d8ce;
        border-radius: 12px;
        padding: 12px 15px;
        min-height: 46px;
        transition: all .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #c68b59;
        box-shadow: 0 0 0 4px rgba(198, 139, 89, .12);
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
    }

    .auto-field {
        position: relative;
    }

    .auto-field .form-control {
        padding-left: 48px;
        background: #faf7f4;
        color: #4a2c20;
        font-weight: 600;
    }

    .auto-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        color: #c68b59;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        border-top: 1px solid #eee5df;
        padding-top: 24px;
    }

    .btn-cancel {
        border: 1px solid #e4d8ce;
        color: #6b554a;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-save {
        background: #4a2c20;
        border-color: #4a2c20;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #6b4030;
        border-color: #6b4030;
        transform: translateY(-1px);
    }

    .text-muted {
        color: #9b867a !important;
        font-size: .78rem;
    }

    @media (max-width: 576px) {
        .form-footer {
            flex-direction: column-reverse;
        }

        .form-footer .btn {
            width: 100%;
        }
    }

</style>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const pelangganSelect = document.getElementById('pelanggan_id');
    const namaPelanggan = document.getElementById('nama_pelanggan');

    function updateNamaPelanggan() {

        const selectedOption =
            pelangganSelect.options[pelangganSelect.selectedIndex];

        if (
            selectedOption &&
            selectedOption.value &&
            selectedOption.dataset.nama
        ) {
            namaPelanggan.value = selectedOption.dataset.nama;
        } else {
            namaPelanggan.value = '';
        }
    }

    pelangganSelect.addEventListener('change', updateNamaPelanggan);

    updateNamaPelanggan();

});
</script>