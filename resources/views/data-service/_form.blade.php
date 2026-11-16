
@php
    $selectedId = old(
        'daftar_service_id',
        $dataService->daftar_service_id ?? ''
    );

    $selectedService = $daftarServices->firstWhere('id', $selectedId);

    $keluhanAwal = old(
        'keluhan_kendaraan',
        $dataService->keluhan_kendaraan ?? ($selectedService->keluhan_kendaraan ?? '')
    );
@endphp

<div class="row g-4">
    <div class="col-12">
        <label for="daftar_service_id" class="form-label">
            ID Servis Pelanggan <span class="text-danger">*</span>
        </label>

        <select
            name="daftar_service_id"
            id="daftar_service_id"
            class="form-select @error('daftar_service_id') is-invalid @enderror"
            required
        >
            <option value="">-- Pilih ID Servis Pelanggan --</option>

            @forelse ($daftarServices as $service)
                <option
                    value="{{ $service->id }}"
                    data-keluhan="{{ $service->keluhan_kendaraan }}"
                    @selected((string) $selectedId === (string) $service->id)
                >
                    {{ $service->id_servis_pelanggan }}
                    — {{ $service->pelanggan->nama_lengkap ?? 'Pelanggan' }}
                    — {{ $service->kendaraan->no_plat ?? '-' }}
                </option>
            @empty
                <option value="" disabled>
                    Tidak ada daftar service yang tersedia
                </option>
            @endforelse
        </select>

        @error('daftar_service_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <small class="text-muted">
            Pilih ID servis pelanggan yang akan dikerjakan.
        </small>
    </div>

    <div class="col-12">
        <label for="keluhan_kendaraan" class="form-label">
            Keluhan Kendaraan <span class="text-danger">*</span>
        </label>

        <textarea
            name="keluhan_kendaraan"
            id="keluhan_kendaraan"
            rows="4"
            class="form-control @error('keluhan_kendaraan') is-invalid @enderror"
            placeholder="Keluhan akan terisi otomatis setelah memilih ID servis..."
            required
        >{{ $keluhanAwal }}</textarea>

        @error('keluhan_kendaraan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <small class="text-muted">
            Keluhan diambil otomatis dari menu Daftar Service. Kamu masih bisa menyesuaikannya.
        </small>
    </div>

    <div class="col-md-6">
        <label for="estimasi_service" class="form-label">
            Estimasi Service (Rp) <span class="text-danger">*</span>
        </label>

        <input
            type="number"
            name="estimasi_service"
            id="estimasi_service"
            class="form-control @error('estimasi_service') is-invalid @enderror"
            value="{{ old('estimasi_service', $dataService->estimasi_service ?? '') }}"
            min="0"
            step="1000"
            placeholder="Contoh: 150000"
            required
        >

        @error('estimasi_service')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nama_mekanik" class="form-label">
            Nama Mekanik <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nama_mekanik"
            id="nama_mekanik"
            class="form-control @error('nama_mekanik') is-invalid @enderror"
            value="{{ old('nama_mekanik', $dataService->nama_mekanik ?? '') }}"
            placeholder="Masukkan nama mekanik"
            maxlength="100"
            required
        >

        @error('nama_mekanik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="sparepart_pengganti" class="form-label">
            Sparepart Pengganti
        </label>

        <textarea
            name="sparepart_pengganti"
            id="sparepart_pengganti"
            rows="3"
            class="form-control @error('sparepart_pengganti') is-invalid @enderror"
            placeholder="Contoh: Oli mesin, kampas rem, busi (boleh dikosongkan)"
        >{{ old('sparepart_pengganti', $dataService->sparepart_pengganti ?? '') }}</textarea>

        @error('sparepart_pengganti')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
    <a href="{{ route('data-service.index') }}" class="btn btn-light">
        Batal
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-check-circle me-1"></i>
        {{ isset($dataService) ? 'Simpan Perubahan' : 'Simpan Data Service' }}
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('daftar_service_id');
    const keluhan = document.getElementById('keluhan_kendaraan');

    if (!dropdown || !keluhan) return;

    dropdown.addEventListener('change', function () {
        const option = this.options[this.selectedIndex];

        if (this.value && option) {
            keluhan.value = option.dataset.keluhan || '';
        } else {
            keluhan.value = '';
        }
    });
});
</script>
