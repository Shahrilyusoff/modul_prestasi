<!-- Bahagian II - Activities and Training -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        BAHAGIAN II - KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI/LATIHAN
    </div>
    <div class="card-body">
        <!-- Form fields for activities -->
        <!-- Form fields for training -->
    </div>
</div>

<!-- SKT based on period type -->
@if($penilaian->tempohPenilaian->jenis === 'sasaran_awal')
    <!-- Initial target setting form -->
@elseif($penilaian->tempohPenilaian->jenis === 'pertengahan')
    <!-- Mid-year review form -->
@endif

<div class="form-group mt-4">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('penilaian.pyd') }}" class="btn btn-secondary">Batal</a>
    
    @if($penilaian->status === 'draf')
        <button type="button" class="btn btn-success float-end" 
                onclick="confirmSubmit()">
            Hantar untuk Penilaian
        </button>
    @endif
</div>

@push('scripts')
<script>
    function confirmSubmit() {
        if(confirm('Adakah anda pasti untuk menghantar penilaian ini?')) {
            // Submit a hidden form to change status
            document.getElementById('submit-form').submit();
        }
    }
</script>
@endpush