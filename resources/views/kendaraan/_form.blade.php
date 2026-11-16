@csrf

<div class="row g-4">

    {{-- No Plat --}}
    <div class="col-md-6">
        <label class="form-label">
            No Plat Kendaraan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="no_plat"
            value="{{ old('no_plat', $kendaraan->no_plat ?? '') }}"
            class="form-control @error('no_plat') is-invalid @enderror"
            placeholder="Contoh: BL 1234 AB"
            required
        >

        @error('no_plat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Jenis Kendaraan --}}
    <div class="col-md-6">
        <label class="form-label">
            Jenis Kendaraan <span class="text-danger">*</span>
        </label>

        <div class="radio-box">

            <label class="radio-option">
                <input
                    type="radio"
                    name="jenis_kendaraan"
                    value="Matic"
                    {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan ?? '') == 'Matic' ? 'checked' : '' }}
                    required
                >

                <span>
                    <i class="bi bi-scooter"></i>
                    Matic
                </span>
            </label>


            <label class="radio-option">
                <input
                    type="radio"
                    name="jenis_kendaraan"
                    value="Manual Transimisi"
                    {{ old('jenis_kendaraan', $kendaraan->jenis_kendaraan ?? '') == 'Manual Transimisi' ? 'checked' : '' }}
                    required
                >

                <span>
                    <i class="bi bi-bicycle"></i>
                    Manual Transimisi
                </span>
            </label>

        </div>

        @error('jenis_kendaraan')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
    </div>


    {{-- No STNK --}}
    <div class="col-md-6">
        <label class="form-label">
            No STNK <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="no_stnk"
            value="{{ old('no_stnk', $kendaraan->no_stnk ?? '') }}"
            class="form-control @error('no_stnk') is-invalid @enderror"
            placeholder="Masukkan nomor STNK"
            required
        >

        @error('no_stnk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Tahun Pembuatan --}}
    <div class="col-md-6">
        <label class="form-label">
            Tahun Pembuatan Kendaraan <span class="text-danger">*</span>
        </label>

        <input
            type="number"
            name="tahun_pembuatan"
            value="{{ old('tahun_pembuatan', $kendaraan->tahun_pembuatan ?? '') }}"
            class="form-control @error('tahun_pembuatan') is-invalid @enderror"
            min="1900"
            max="{{ date('Y') }}"
            placeholder="Contoh: 2022"
            required
        >

        @error('tahun_pembuatan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Nama Pemilik --}}
    <div class="col-md-6">
        <label class="form-label">
            Nama Pemilik <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nama_pemilik"
            value="{{ old('nama_pemilik', $kendaraan->nama_pemilik ?? '') }}"
            class="form-control @error('nama_pemilik') is-invalid @enderror"
            placeholder="Masukkan nama pemilik kendaraan"
            required
        >

        @error('nama_pemilik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Warna Kendaraan --}}
    <div class="col-md-6">
        <label class="form-label">
            Warna Kendaraan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="warna_kendaraan"
            value="{{ old('warna_kendaraan', $kendaraan->warna_kendaraan ?? '') }}"
            class="form-control @error('warna_kendaraan') is-invalid @enderror"
            placeholder="Contoh: Hitam"
            required
        >

        @error('warna_kendaraan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>


{{-- Tombol --}}
<div class="form-footer mt-4">

    <a href="{{ route('kendaraan.index') }}" class="btn btn-light btn-cancel">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

    <button type="submit" class="btn btn-primary btn-save">
        <i class="bi bi-check-circle"></i>

        {{ isset($kendaraan) ? 'Simpan Perubahan' : 'Simpan Kendaraan' }}
    </button>

</div>


<style>
    .form-label {
        font-weight: 700;
        color: #4a2c20;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e4d8ce;
        border-radius: 12px;
        padding: 12px 15px;
        min-height: 46px;
        transition: all .2s ease;
    }

    .form-control:focus {
        border-color: #c68b59;
        box-shadow: 0 0 0 4px rgba(198, 139, 89, .12);
    }

    .radio-box {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .radio-option {
        flex: 1;
        min-width: 180px;
        cursor: pointer;
    }

    .radio-option input {
        display: none;
    }

    .radio-option span {
        min-height: 46px;
        border: 1px solid #e4d8ce;
        border-radius: 12px;
        background: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0 16px;
        font-weight: 600;
        color: #6b554a;
        transition: all .2s ease;
    }

    .radio-option span i {
        color: #c68b59;
        font-size: 1.1rem;
    }

    .radio-option input:checked + span {
        border-color: #c68b59;
        background: #fff7ef;
        color: #4a2c20;
        box-shadow: 0 0 0 3px rgba(198, 139, 89, .1);
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

    @media (max-width: 576px) {
        .radio-option {
            min-width: 100%;
        }

        .form-footer {
            flex-direction: column-reverse;
        }

        .form-footer .btn {
            width: 100%;
        }
    }
</style>