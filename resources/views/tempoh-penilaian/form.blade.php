<!-- resources/views/tempoh-penilaian/form.blade.php -->

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="nama_tempoh" class="form-label">{{ __('Nama Tempoh') }}</label>
            <input type="text" class="form-control @error('nama_tempoh') is-invalid @enderror" id="nama_tempoh" name="nama_tempoh" value="{{ old('nama_tempoh', $tempohPenilaian->nama_tempoh ?? '') }}" required>
            @error('nama_tempoh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="jenis" class="form-label">{{ __('Jenis') }}</label>
            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis" required>
                <option value="">{{ __('Pilih Jenis') }}</option>
                <option value="sasaran_awal" {{ old('jenis', $tempohPenilaian->jenis ?? '') == 'sasaran_awal' ? 'selected' : '' }}>{{ __('Sasaran Awal') }}</option>
                <option value="pertengahan" {{ old('jenis', $tempohPenilaian->jenis ?? '') == 'pertengahan' ? 'selected' : '' }}>{{ __('Pertengahan Tahun') }}</option>
                <option value="akhir" {{ old('jenis', $tempohPenilaian->jenis ?? '') == 'akhir' ? 'selected' : '' }}>{{ __('Akhir Tahun') }}</option>
            </select>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="tarikh_mula" class="form-label">{{ __('Tarikh Mula') }}</label>
            <input type="date" class="form-control @error('tarikh_mula') is-invalid @enderror" id="tarikh_mula" name="tarikh_mula" value="{{ old('tarikh_mula', isset($tempohPenilaian->tarikh_mula) ? $tempohPenilaian->tarikh_mula->format('Y-m-d') : '') }}" required>
            @error('tarikh_mula')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="tarikh_tamat" class="form-label">{{ __('Tarikh Tamat') }}</label>
            <input type="date" class="form-control @error('tarikh_tamat') is-invalid @enderror" id="tarikh_tamat" name="tarikh_tamat" value="{{ old('tarikh_tamat', isset($tempohPenilaian->tarikh_tamat) ? $tempohPenilaian->tarikh_tamat->format('Y-m-d') : '') }}" required>
            @error('tarikh_tamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="aktif" name="aktif" {{ old('aktif', $tempohPenilaian->aktif ?? false) ? 'checked' : '' }}>
    <label class="form-check-label" for="aktif">{{ __('Aktif') }}</label>
</div>

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
</div>