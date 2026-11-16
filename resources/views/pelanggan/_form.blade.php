<div class="row g-4">

    {{-- ID Pelanggan --}}
    <div class="col-md-6">
        <label for="id_pelanggan" class="form-label">
            ID Pelanggan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="id_pelanggan"
            id="id_pelanggan"
            class="form-control @error('id_pelanggan') is-invalid @enderror"
            value="{{ old('id_pelanggan', $pelanggan->id_pelanggan ?? '') }}"
            placeholder="Contoh: PLG001"
            required
        >

        @error('id_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Nama Lengkap --}}
    <div class="col-md-6">
        <label for="nama_lengkap" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nama_lengkap"
            id="nama_lengkap"
            class="form-control @error('nama_lengkap') is-invalid @enderror"
            value="{{ old('nama_lengkap', $pelanggan->nama_lengkap ?? '') }}"
            placeholder="Masukkan nama lengkap"
            required
        >

        @error('nama_lengkap')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- No HP --}}
    <div class="col-md-6">
        <label for="no_hp" class="form-label">
            No HP <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="no_hp"
            id="no_hp"
            class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}"
            placeholder="Contoh: 081234567890"
            required
        >

        @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Pekerjaan --}}
    <div class="col-md-6">
        <label for="pekerjaan" class="form-label">
            Pekerjaan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="pekerjaan"
            id="pekerjaan"
            class="form-control @error('pekerjaan') is-invalid @enderror"
            value="{{ old('pekerjaan', $pelanggan->pekerjaan ?? '') }}"
            placeholder="Contoh: Wiraswasta"
            required
        >

        @error('pekerjaan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Alamat --}}
    <div class="col-12">
        <label for="alamat" class="form-label">
            Alamat Pelanggan <span class="text-danger">*</span>
        </label>

        <textarea
            name="alamat"
            id="alamat"
            rows="4"
            class="form-control @error('alamat') is-invalid @enderror"
            placeholder="Masukkan alamat pelanggan"
            required
        >{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>

        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

</div>