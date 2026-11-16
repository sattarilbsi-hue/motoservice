
<div class="row g-3">

    {{-- ID SERVIS PELANGGAN --}}
    <div class="col-md-12">
        <label class="form-label fw-semibold" style="color:#4A2C20;">
            ID Servis Pelanggan <span class="text-danger">*</span>
        </label>

        <select name="daftar_service_id"
                id="daftar_service_id"
                class="form-select"
                required>
            <option value="">-- Pilih ID Servis Pelanggan --</option>

            @foreach($daftarServices as $service)
                <option value="{{ $service->id }}"
                    {{ old('daftar_service_id', $pembayaran->daftar_service_id ?? '') == $service->id ? 'selected' : '' }}>
                    {{ $service->id_servis_pelanggan }}
                    — {{ $service->pelanggan->nama_lengkap ?? '-' }}
                    — {{ $service->kendaraan->no_plat ?? '-' }}
                </option>
            @endforeach
        </select>

        @error('daftar_service_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

        @if($daftarServices->isEmpty())
            <small class="text-danger d-block mt-2">
                Belum ada service yang memiliki Data Service dan belum dibayar.
            </small>
        @endif
    </div>

    {{-- JUMLAH BIAYA --}}
    <div class="col-md-12">
        <label class="form-label fw-semibold" style="color:#4A2C20;">
            Jumlah Biaya Servis <span class="text-danger">*</span>
        </label>

        <div class="input-group">
            <span class="input-group-text"
                  style="background:#F7F0E8; color:#79543D;">Rp</span>

            <input type="number"
                   name="jumlah_biaya_servis"
                   class="form-control"
                   min="0"
                   step="0.01"
                   placeholder="Masukkan jumlah biaya servis"
                   value="{{ old('jumlah_biaya_servis', $pembayaran->jumlah_biaya_servis ?? '') }}"
                   required>
        </div>

        @error('jumlah_biaya_servis')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- JENIS PEMBAYARAN --}}
    <div class="col-md-12">
        <label class="form-label fw-semibold d-block" style="color:#4A2C20;">
            Jenis Pembayaran
        </label>

        <div class="d-flex flex-wrap gap-3">
            <label class="border rounded-3 p-3 flex-fill"
                   style="border-color:#E8DDD1 !important;">
                <input type="radio"
                       name="jenis_pembayaran"
                       value="Cash / Tunai"
                       {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran ?? '') == 'Cash / Tunai' ? 'checked' : '' }}>
                <i class="bi bi-cash ms-2 me-1" style="color:#79543D;"></i>
                Cash / Tunai
            </label>

            <label class="border rounded-3 p-3 flex-fill"
                   style="border-color:#E8DDD1 !important;">
                <input type="radio"
                       name="jenis_pembayaran"
                       value="Non Tunai"
                       {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran ?? '') == 'Non Tunai' ? 'checked' : '' }}>
                <i class="bi bi-credit-card ms-2 me-1" style="color:#79543D;"></i>
                Non Tunai
            </label>
        </div>

        @error('jenis_pembayaran')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

        <small class="text-muted">
            Jenis pembayaran boleh dikosongkan.
        </small>
    </div>

    {{-- KETERANGAN --}}
    <div class="col-md-12">
        <label class="form-label fw-semibold" style="color:#4A2C20;">
            Keterangan
        </label>

        <textarea name="keterangan"
                  class="form-control"
                  rows="3"
                  placeholder="Masukkan keterangan pembayaran (opsional)">{{ old('keterangan', $pembayaran->keterangan ?? '') }}</textarea>

        @error('keterangan')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('pembayaran.index') }}"
       class="btn px-4"
       style="background:#F7F0E8; color:#79543D; border-radius:10px;">
        Batal
    </a>

    <button type="submit"
            class="btn text-white px-4"
            style="background:#79543D; border-radius:10px;">
        <i class="bi bi-save me-1"></i>
        {{ isset($pembayaran) ? 'Simpan Perubahan' : 'Simpan Pembayaran' }}
    </button>
</div>
