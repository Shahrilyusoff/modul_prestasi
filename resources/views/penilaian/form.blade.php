<!-- resources/views/penilaian/form.blade.php -->

@csrf
@if(isset($penilaian) && $penilaian->id)
    @method('PUT')
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="tempoh_penilaian_id" class="form-label">{{ __('Tempoh Penilaian') }}</label>
            <select class="form-select @error('tempoh_penilaian_id') is-invalid @enderror" id="tempoh_penilaian_id" name="tempoh_penilaian_id" required {{ isset($penilaian) && $penilaian->id ? 'disabled' : '' }}>
                <option value="">{{ __('Pilih Tempoh Penilaian') }}</option>
                @foreach($tempohPenilaian as $tempoh)
                <option value="{{ $tempoh->id }}" {{ old('tempoh_penilaian_id', $penilaian->tempoh_penilaian_id ?? '') == $tempoh->id ? 'selected' : '' }}>
                    {{ $tempoh->nama_tempoh }} ({{ $tempoh->tarikh_mula->format('d/m/Y') }} - {{ $tempoh->tarikh_tamat->format('d/m/Y') }})
                </option>
                @endforeach
            </select>
            @error('tempoh_penilaian_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="pyd_id" class="form-label">{{ __('PYD') }}</label>
            <select class="form-select @error('pyd_id') is-invalid @enderror" id="pyd_id" name="pyd_id" required {{ isset($penilaian) && $penilaian->id ? 'disabled' : '' }}>
                <option value="">{{ __('Pilih PYD') }}</option>
                @foreach($pydOptions as $pyd)
                <option value="{{ $pyd->id }}" {{ old('pyd_id', $penilaian->pyd_id ?? '') == $pyd->id ? 'selected' : '' }}>
                    {{ $pyd->name }} ({{ $pyd->jawatan }})
                </option>
                @endforeach
            </select>
            @error('pyd_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="mb-3">
            <label for="ppp_id" class="form-label">{{ __('PPP') }}</label>
            <select class="form-select @error('ppp_id') is-invalid @enderror" id="ppp_id" name="ppp_id" required {{ isset($penilaian) && $penilaian->id ? 'disabled' : '' }}>
                <option value="">{{ __('Pilih PPP') }}</option>
                @foreach($pppOptions as $ppp)
                <option value="{{ $ppp->id }}" {{ old('ppp_id', $penilaian->ppp_id ?? '') == $ppp->id ? 'selected' : '' }}>
                    {{ $ppp->name }} ({{ $ppp->jawatan }})
                </option>
                @endforeach
            </select>
            @error('ppp_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="mb-3">
            <label for="ppk_id" class="form-label">{{ __('PPK') }}</label>
            <select class="form-select @error('ppk_id') is-invalid @enderror" id="ppk_id" name="ppk_id" {{ isset($penilaian) && $penilaian->id ? 'disabled' : '' }}>
                <option value="">{{ __('Pilih PPK') }}</option>
                @foreach($ppkOptions as $ppk)
                <option value="{{ $ppk->id }}" {{ old('ppk_id', $penilaian->ppk_id ?? '') == $ppk->id ? 'selected' : '' }}>
                    {{ $ppk->name }} ({{ $ppk->jawatan }})
                </option>
                @endforeach
            </select>
            @error('ppk_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@if(isset($penilaian) && $penilaian->id)
    <!-- Only show these sections if editing an existing penilaian -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ __('BAHAGIAN II - KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI/LATIHAN') }}
        </div>
        <div class="card-body">
            <h5 class="mb-3">1. {{ __('KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI') }}</h5>
            
            <div id="kegiatan-container">
                @if(old('kegiatan', isset($penilaian) ? $penilaian->kegiatanLuar->toArray() : []))
                    @foreach(old('kegiatan', isset($penilaian) ? $penilaian->kegiatanLuar->toArray() : []) as $index => $kegiatan)
                    <div class="row kegiatan-row mb-3">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="kegiatan[{{ $index }}][kegiatan]" placeholder="{{ __('Kegiatan/Aktiviti/Sumbangan') }}" value="{{ $kegiatan['kegiatan'] ?? '' }}" required>
                        </div>
                        <div class="col-md-5">
                            <select class="form-select" name="kegiatan[{{ $index }}][peringkat]" required>
                                <option value="">{{ __('Pilih Peringkat') }}</option>
                                <option value="komuniti" {{ ($kegiatan['peringkat'] ?? '') == 'komuniti' ? 'selected' : '' }}>{{ __('Komuniti') }}</option>
                                <option value="jabatan" {{ ($kegiatan['peringkat'] ?? '') == 'jabatan' ? 'selected' : '' }}>{{ __('Jabatan') }}</option>
                                <option value="daerah" {{ ($kegiatan['peringkat'] ?? '') == 'daerah' ? 'selected' : '' }}>{{ __('Daerah') }}</option>
                                <option value="negeri" {{ ($kegiatan['peringkat'] ?? '') == 'negeri' ? 'selected' : '' }}>{{ __('Negeri') }}</option>
                                <option value="negara" {{ ($kegiatan['peringkat'] ?? '') == 'negara' ? 'selected' : '' }}>{{ __('Negara') }}</option>
                                <option value="antarabangsa" {{ ($kegiatan['peringkat'] ?? '') == 'antarabangsa' ? 'selected' : '' }}>{{ __('Antarabangsa') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-kegiatan"><i class="fas fa-trash"></i></button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="row kegiatan-row mb-3">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="kegiatan[0][kegiatan]" placeholder="{{ __('Kegiatan/Aktiviti/Sumbangan') }}" required>
                        </div>
                        <div class="col-md-5">
                            <select class="form-select" name="kegiatan[0][peringkat]" required>
                                <option value="">{{ __('Pilih Peringkat') }}</option>
                                <option value="komuniti">{{ __('Komuniti') }}</option>
                                <option value="jabatan">{{ __('Jabatan') }}</option>
                                <option value="daerah">{{ __('Daerah') }}</option>
                                <option value="negeri">{{ __('Negeri') }}</option>
                                <option value="negara">{{ __('Negara') }}</option>
                                <option value="antarabangsa">{{ __('Antarabangsa') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <!-- No delete button for first row -->
                        </div>
                    </div>
                @endif
            </div>
            <button type="button" id="add-kegiatan" class="btn btn-sm btn-secondary mt-2">
                <i class="fas fa-plus"></i> {{ __('Tambah Kegiatan') }}
            </button>

            <h5 class="mt-4 mb-3">2. {{ __('LATIHAN') }}</h5>
            <p>i) {{ __('Latihan yang dihadiri') }}</p>
            
            <div id="latihan-container">
                @if(old('latihan', isset($penilaian) ? $penilaian->latihan->where('diperlukan', false)->toArray() : []))
                    @foreach(old('latihan', isset($penilaian) ? $penilaian->latihan->where('diperlukan', false)->toArray() : []) as $index => $latihan)
                    <div class="row latihan-row mb-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="latihan[{{ $index }}][nama_latihan]" placeholder="{{ __('Nama Latihan') }}" value="{{ $latihan['nama_latihan'] ?? '' }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="latihan[{{ $index }}][sijil]" placeholder="{{ __('No. Sijil') }}" value="{{ $latihan['sijil'] ?? '' }}">
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="latihan[{{ $index }}][tarikh_mula]" value="{{ isset($latihan['tarikh_mula']) ? \Carbon\Carbon::parse($latihan['tarikh_mula'])->format('Y-m-d') : '' }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="latihan[{{ $index }}][tarikh_tamat]" value="{{ isset($latihan['tarikh_tamat']) ? \Carbon\Carbon::parse($latihan['tarikh_tamat'])->format('Y-m-d') : '' }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="latihan[{{ $index }}][tempat]" placeholder="{{ __('Tempat') }}" value="{{ $latihan['tempat'] ?? '' }}" required>
                        </div>
                        <div class="col-md-1">
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-latihan"><i class="fas fa-trash"></i></button>
                            @endif
                        </div>
                        <input type="hidden" name="latihan[{{ $index }}][diperlukan]" value="0">
                    </div>
                    @endforeach
                @else
                    <div class="row latihan-row mb-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="latihan[0][nama_latihan]" placeholder="{{ __('Nama Latihan') }}" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="latihan[0][sijil]" placeholder="{{ __('No. Sijil') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="latihan[0][tarikh_mula]" required>
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" name="latihan[0][tarikh_tamat]" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="latihan[0][tempat]" placeholder="{{ __('Tempat') }}" required>
                        </div>
                        <div class="col-md-1">
                            <!-- No delete button for first row -->
                        </div>
                        <input type="hidden" name="latihan[0][diperlukan]" value="0">
                    </div>
                @endif
            </div>
            <button type="button" id="add-latihan" class="btn btn-sm btn-secondary mt-2">
                <i class="fas fa-plus"></i> {{ __('Tambah Latihan') }}
            </button>

            <p class="mt-4">ii) {{ __('Latihan yang diperlukan') }}</p>
            
            <div id="latihan-diperlukan-container">
                @if(old('latihan_diperlukan', isset($penilaian) ? $penilaian->latihan->where('diperlukan', true)->toArray() : []))
                    @foreach(old('latihan_diperlukan', isset($penilaian) ? $penilaian->latihan->where('diperlukan', true)->toArray() : []) as $index => $latihan)
                    <div class="row latihan-diperlukan-row mb-3">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="latihan_diperlukan[{{ $index }}][nama_latihan]" placeholder="{{ __('Nama/Bidang Latihan') }}" value="{{ $latihan['nama_latihan'] ?? '' }}" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="latihan_diperlukan[{{ $index }}][sebab_diperlukan]" placeholder="{{ __('Sebab Diperlukan') }}" value="{{ $latihan['sebab_diperlukan'] ?? '' }}" required>
                        </div>
                        <div class="col-md-2">
                            @if($index > 0)
                                <button type="button" class="btn btn-danger remove-latihan-diperlukan"><i class="fas fa-trash"></i></button>
                            @endif
                        </div>
                        <input type="hidden" name="latihan_diperlukan[{{ $index }}][diperlukan]" value="1">
                    </div>
                    @endforeach
                @else
                    <div class="row latihan-diperlukan-row mb-3">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="latihan_diperlukan[0][nama_latihan]" placeholder="{{ __('Nama/Bidang Latihan') }}" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="latihan_diperlukan[0][sebab_diperlukan]" placeholder="{{ __('Sebab Diperlukan') }}" required>
                        </div>
                        <div class="col-md-2">
                            <!-- No delete button for first row -->
                        </div>
                        <input type="hidden" name="latihan_diperlukan[0][diperlukan]" value="1">
                    </div>
                @endif
            </div>
            <button type="button" id="add-latihan-diperlukan" class="btn btn-sm btn-secondary mt-2">
                <i class="fas fa-plus"></i> {{ __('Tambah Latihan Diperlukan') }}
            </button>
        </div>
    </div>

    <!-- SKT Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            {{ __('SASARAN KERJA TAHUNAN') }}
        </div>
        <div class="card-body">
            @if($penilaian->tempohPenilaian->jenis === 'sasaran_awal')
                <h5 class="mb-3">{{ __('BAHAGIAN I - PENETAPAN SASARAN KERJA TAHUNAN') }}</h5>
                <p class="text-muted">{{ __('PYD dan PPP hendaklah berbincang bersama sebelum menetapkan SKT dan petunjuk prestasinya') }}</p>
                
                <div id="sasaran-awal-container">
                    @if(old('sasaran_awal', isset($penilaian) ? $penilaian->sasaranKerja->where('bahagian', 'awal')->toArray() : []))
                        @foreach(old('sasaran_awal', isset($penilaian) ? $penilaian->sasaranKerja->where('bahagian', 'awal')->toArray() : []) as $index => $sasaran)
                        <div class="row sasaran-awal-row mb-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_awal[{{ $index }}][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" value="{{ $sasaran['aktiviti'] ?? '' }}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_awal[{{ $index }}][petunjuk_prestasi]" placeholder="{{ __('Petunjuk Prestasi (Kuantiti/Kualiti/Masa/Kos)') }}" value="{{ $sasaran['petunjuk_prestasi'] ?? '' }}" required>
                            </div>
                            <div class="col-md-2">
                                @if($index > 0)
                                    <button type="button" class="btn btn-danger remove-sasaran-awal"><i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                            <input type="hidden" name="sasaran_awal[{{ $index }}][bahagian]" value="awal">
                        </div>
                        @endforeach
                    @else
                        <div class="row sasaran-awal-row mb-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_awal[0][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_awal[0][petunjuk_prestasi]" placeholder="{{ __('Petunjuk Prestasi (Kuantiti/Kualiti/Masa/Kos)') }}" required>
                            </div>
                            <div class="col-md-2">
                                <!-- No delete button for first row -->
                            </div>
                            <input type="hidden" name="sasaran_awal[0][bahagian]" value="awal">
                        </div>
                    @endif
                </div>
                <button type="button" id="add-sasaran-awal" class="btn btn-sm btn-secondary mt-2">
                    <i class="fas fa-plus"></i> {{ __('Tambah Sasaran') }}
                </button>
            @endif

            @if($penilaian->tempohPenilaian->jenis === 'pertengahan')
                <h5 class="mb-3">{{ __('BAHAGIAN II - KAJIAN SEMULA SASARAN KERJA TAHUNAN PERTENGAHAN TAHUN') }}</h5>
                
                <p>1. {{ __('Aktiviti/Projek Yang Ditambah') }}</p>
                <div id="sasaran-tambah-container">
                    @if(old('sasaran_tambah', isset($penilaian) ? $penilaian->sasaranKerja->where('bahagian', 'pertengahan')->where('ditambah', true)->toArray() : []))
                        @foreach(old('sasaran_tambah', isset($penilaian) ? $penilaian->sasaranKerja->where('bahagian', 'pertengahan')->where('ditambah', true)->toArray() : []) as $index => $sasaran)
                        <div class="row sasaran-tambah-row mb-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_tambah[{{ $index }}][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" value="{{ $sasaran['aktiviti'] ?? '' }}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_tambah[{{ $index }}][petunjuk_prestasi]" placeholder="{{ __('Petunjuk Prestasi (Kuantiti/Kualiti/Masa/Kos)') }}" value="{{ $sasaran['petunjuk_prestasi'] ?? '' }}" required>
                            </div>
                            <div class="col-md-2">
                                @if($index > 0)
                                    <button type="button" class="btn btn-danger remove-sasaran-tambah"><i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                            <input type="hidden" name="sasaran_tambah[{{ $index }}][bahagian]" value="pertengahan">
                            <input type="hidden" name="sasaran_tambah[{{ $index }}][ditambah]" value="1">
                        </div>
                        @endforeach
                    @else
                        <div class="row sasaran-tambah-row mb-3">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_tambah[0][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="sasaran_tambah[0][petunjuk_prestasi]" placeholder="{{ __('Petunjuk Prestasi (Kuantiti/Kualiti/Masa/Kos)') }}" required>
                            </div>
                            <div class="col-md-2">
                                <!-- No delete button for first row -->
                            </div>
                            <input type="hidden" name="sasaran_tambah[0][bahagian]" value="pertengahan">
                            <input type="hidden" name="sasaran_tambah[0][ditambah]" value="1">
                        </div>
                    @endif
                </div>
                <button type="button" id="add-sasaran-tambah" class="btn btn-sm btn-secondary mt-2">
                    <i class="fas fa-plus"></i> {{ __('Tambah Sasaran') }}
                </button>

                <p class="mt-4">2. {{ __('Aktiviti/Projek Yang Digugurkan') }}</p>
                <div id="sasaran-gugur-container">
                    @if(old('sasaran_gugur', isset($penilaian) ? $penilaian->sasaranKerja->where('bahagian', 'pertengahan')->where('digugurkan', true)->toArray() : []))
                        @foreach(old('sasaran_gugur', isset($penilaian) ? $penilaian->sasaranKerja->where('bahagian', 'pertengahan')->where('digugurkan', true)->toArray() : []) as $index => $sasaran)
                        <div class="row sasaran-gugur-row mb-3">
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="sasaran_gugur[{{ $index }}][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" value="{{ $sasaran['aktiviti'] ?? '' }}" required>
                            </div>
                            <div class="col-md-2">
                                @if($index > 0)
                                    <button type="button" class="btn btn-danger remove-sasaran-gugur"><i class="fas fa-trash"></i></button>
                                @endif
                            </div>
                            <input type="hidden" name="sasaran_gugur[{{ $index }}][bahagian]" value="pertengahan">
                            <input type="hidden" name="sasaran_gugur[{{ $index }}][digugurkan]" value="1">
                        </div>
                        @endforeach
                    @else
                        <div class="row sasaran-gugur-row mb-3">
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="sasaran_gugur[0][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" required>
                            </div>
                            <div class="col-md-2">
                                <!-- No delete button for first row -->
                            </div>
                            <input type="hidden" name="sasaran_gugur[0][bahagian]" value="pertengahan">
                            <input type="hidden" name="sasaran_gugur[0][digugurkan]" value="1">
                        </div>
                    @endif
                </div>
                <button type="button" id="add-sasaran-gugur" class="btn btn-sm btn-secondary mt-2">
                    <i class="fas fa-plus"></i> {{ __('Tambah Sasaran Digugurkan') }}
                </button>
            @endif

            @if($penilaian->tempohPenilaian->jenis === 'akhir')
                <h5 class="mb-3">{{ __('BAHAGIAN III - LAPORAN DAN ULASAN KESELURUHAN PENCAPAIAN SASARAN KERJA TAHUNAN PADA AKHIR TAHUN OLEH PYD DAN PPP') }}</h5>
                
                <p>1. {{ __('Laporan/Ulasan Oleh PYD') }}</p>
                @foreach($penilaian->sasaranKerja->where('bahagian', 'awal') as $index => $sasaran)
                <div class="mb-3">
                    <label class="form-label">{{ $sasaran->aktiviti }}</label>
                    <textarea class="form-control" name="sasaran_ulasan_pyd[{{ $sasaran->id }}]" rows="2">{{ old("sasaran_ulasan_pyd.{$sasaran->id}", $sasaran->ulasan_pyd) }}</textarea>
                </div>
                @endforeach

                @if(auth()->user()->role === 'ppp')
                    <p class="mt-4">2. {{ __('Laporan/Ulasan Oleh PPP') }}</p>
                    @foreach($penilaian->sasaranKerja->where('bahagian', 'awal') as $index => $sasaran)
                    <div class="mb-3">
                        <label class="form-label">{{ $sasaran->aktiviti }}</label>
                        <textarea class="form-control" name="sasaran_ulasan_ppp[{{ $sasaran->id }}]" rows="2">{{ old("sasaran_ulasan_ppp.{$sasaran->id}", $sasaran->ulasan_ppp) }}</textarea>
                    </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>

    @if(auth()->user()->role === 'ppp' || auth()->user()->role === 'ppk')
        <!-- Evaluation Sections -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                {{ __('PENILAIAN PRESTASI') }}
            </div>
            <div class="card-body">
                <!-- Bahagian III -->
                <h5 class="mb-3">{{ __('BAHAGIAN III - PENGHASILAN KERJA (Wajaran 50%)') }}</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="70%">{{ __('Kriteria') }}</th>
                                <th>{{ __('Markah (1-10)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Helpers\Helpers::getKriteriaLabels('iii') as $key => $kriteria)
                            <tr>
                                <td>{{ $kriteria }}</td>
                                <td>
                                    <input type="number" class="form-control" name="bahagian_iii[{{ $key }}]" min="1" max="10" 
                                           value="{{ old("bahagian_iii.{$key}", $penilaian->bahagian_iii[$key][auth()->user()->role] ?? '') }}" required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Bahagian IV -->
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN IV - PENGETAHUAN DAN KEMAHIRAN (Wajaran 25%)') }}</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="70%">{{ __('Kriteria') }}</th>
                                <th>{{ __('Markah (1-10)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Helpers\Helpers::getKriteriaLabels('iv') as $key => $kriteria)
                            <tr>
                                <td>{{ $kriteria }}</td>
                                <td>
                                    <input type="number" class="form-control" name="bahagian_iv[{{ $key }}]" min="1" max="10" 
                                           value="{{ old("bahagian_iv.{$key}", $penilaian->bahagian_iv[$key][auth()->user()->role] ?? '') }}" required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Bahagian V -->
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN V - KUALITI PERIBADI (Wajaran 20%)') }}</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="70%">{{ __('Kriteria') }}</th>
                                <th>{{ __('Markah (1-10)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Helpers\Helpers::getKriteriaLabels('v') as $key => $kriteria)
                            <tr>
                                <td>{{ $kriteria }}</td>
                                <td>
                                    <input type="number" class="form-control" name="bahagian_v[{{ $key }}]" min="1" max="10" 
                                           value="{{ old("bahagian_v.{$key}", $penilaian->bahagian_v[$key][auth()->user()->role] ?? '') }}" required>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Bahagian VI -->
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN VI - KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI (Wajaran 5%)') }}</h5>
                <div class="mb-3">
                    <label class="form-label">{{ __('Markah (1-10)') }}</label>
                    <input type="number" class="form-control" name="bahagian_vi" min="0" max="10" 
                           value="{{ old('bahagian_vi', auth()->user()->role === 'ppp' ? $penilaian->bahagian_vi_ppp : $penilaian->bahagian_vi_ppk) }}">
                </div>

                @if(auth()->user()->role === 'ppp')
                    <!-- Bahagian VIII - Ulasan PPP -->
                    <h5 class="mt-4 mb-3">{{ __('BAHAGIAN VIII - ULASAN KESELURUHAN DAN PENGESAHAN OLEH PEGAWAI PENILAI PERTAMA') }}</h5>
                    <div class="mb-3">
                        <label class="form-label">{{ __('1. Tempoh PYD bertugas di bawah pengawasan:') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('Tahun') }}</label>
                                <input type="number" class="form-control" name="tempoh_penilaian_tahun" 
                                       value="{{ old('tempoh_penilaian_tahun', $penilaian->tempoh_penilaian_ppp ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppp)->format('Y') : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('Bulan') }}</label>
                                <input type="number" class="form-control" name="tempoh_penilaian_bulan" min="1" max="12"
                                       value="{{ old('tempoh_penilaian_bulan', $penilaian->tempoh_penilaian_ppp ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppp)->format('m') : '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('2. Penilai Pertama hendaklah memberi ulasan keseluruhan prestasi PYD.') }}</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('i) Prestasi keseluruhan:') }}</label>
                        <textarea class="form-control" name="ulasan_ppp" rows="3">{{ old('ulasan_ppp', $penilaian->ulasan_ppp) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('ii) Kemajuan kerjaya:') }}</label>
                        <textarea class="form-control" name="ulasan_kerjaya_ppp" rows="3">{{ old('ulasan_kerjaya_ppp') }}</textarea>
                    </div>
                @endif

                @if(auth()->user()->role === 'ppk')
                    <!-- Bahagian IX - Ulasan PPK -->
                    <h5 class="mt-4 mb-3">{{ __('BAHAGIAN IX - ULASAN KESELURUHAN DAN PENGESAHAN OLEH PEGAWAI PENILAI KEDUA') }}</h5>
                    <div class="mb-3">
                        <label class="form-label">{{ __('1. Tempoh PYD bertugas di bawah pengawasan:') }}</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('Tahun') }}</label>
                                <input type="number" class="form-control" name="tempoh_penilaian_tahun" 
                                       value="{{ old('tempoh_penilaian_tahun', $penilaian->tempoh_penilaian_ppk ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppk)->format('Y') : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label>{{ __('Bulan') }}</label>
                                <input type="number" class="form-control" name="tempoh_penilaian_bulan" min="1" max="12"
                                       value="{{ old('tempoh_penilaian_bulan', $penilaian->tempoh_penilaian_ppk ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppk)->format('m') : '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('2. PPK hendaklah memberi ulasan keseluruhan pencapaian prestasi PYD berasaskan ulasan keseluruhan oleh PPP') }}</label>
                        <textarea class="form-control" name="ulasan_ppk" rows="3">{{ old('ulasan_ppk', $penilaian->ulasan_ppk) }}</textarea>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endif

<div class="d-flex justify-content-between">
    <a href="{{ isset($penilaian) && $penilaian->id ? route('penilaian.show', $penilaian->id) : route('penilaian.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> {{ __('Kembali') }}
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> {{ __('Simpan') }}
    </button>
</div>

@push('scripts')
<script>
    // Kegiatan Luar Dynamic Fields
    $('#add-kegiatan').click(function() {
        let index = $('.kegiatan-row').length;
        let html = `
        <div class="row kegiatan-row mb-3">
            <div class="col-md-5">
                <input type="text" class="form-control" name="kegiatan[${index}][kegiatan]" placeholder="{{ __('Kegiatan/Aktiviti/Sumbangan') }}" required>
            </div>
            <div class="col-md-5">
                <select class="form-select" name="kegiatan[${index}][peringkat]" required>
                    <option value="">{{ __('Pilih Peringkat') }}</option>
                    <option value="komuniti">{{ __('Komuniti') }}</option>
                    <option value="jabatan">{{ __('Jabatan') }}</option>
                    <option value="daerah">{{ __('Daerah') }}</option>
                    <option value="negeri">{{ __('Negeri') }}</option>
                    <option value="negara">{{ __('Negara') }}</option>
                    <option value="antarabangsa">{{ __('Antarabangsa') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-kegiatan"><i class="fas fa-trash"></i></button>
            </div>
        </div>`;
        $('#kegiatan-container').append(html);
    });

    $(document).on('click', '.remove-kegiatan', function() {
        $(this).closest('.kegiatan-row').remove();
        reindexFields('.kegiatan-row', 'kegiatan');
    });

    // Latihan Dynamic Fields
    $('#add-latihan').click(function() {
        let index = $('.latihan-row').length;
        let html = `
        <div class="row latihan-row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" name="latihan[${index}][nama_latihan]" placeholder="{{ __('Nama Latihan') }}" required>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="latihan[${index}][sijil]" placeholder="{{ __('No. Sijil') }}">
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="latihan[${index}][tarikh_mula]" required>
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="latihan[${index}][tarikh_tamat]" required>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="latihan[${index}][tempat]" placeholder="{{ __('Tempat') }}" required>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-latihan"><i class="fas fa-trash"></i></button>
            </div>
            <input type="hidden" name="latihan[${index}][diperlukan]" value="0">
        </div>`;
        $('#latihan-container').append(html);
    });

    $(document).on('click', '.remove-latihan', function() {
        $(this).closest('.latihan-row').remove();
        reindexFields('.latihan-row', 'latihan');
    });

    // Latihan Diperlukan Dynamic Fields
    $('#add-latihan-diperlukan').click(function() {
        let index = $('.latihan-diperlukan-row').length;
        let html = `
        <div class="row latihan-diperlukan-row mb-3">
            <div class="col-md-5">
                <input type="text" class="form-control" name="latihan_diperlukan[${index}][nama_latihan]" placeholder="{{ __('Nama/Bidang Latihan') }}" required>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="latihan_diperlukan[${index}][sebab_diperlukan]" placeholder="{{ __('Sebab Diperlukan') }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-latihan-diperlukan"><i class="fas fa-trash"></i></button>
            </div>
            <input type="hidden" name="latihan_diperlukan[${index}][diperlukan]" value="1">
        </div>`;
        $('#latihan-diperlukan-container').append(html);
    });

    $(document).on('click', '.remove-latihan-diperlukan', function() {
        $(this).closest('.latihan-diperlukan-row').remove();
        reindexFields('.latihan-diperlukan-row', 'latihan_diperlukan');
    });

    // Sasaran Awal Dynamic Fields
    $('#add-sasaran-awal').click(function() {
        let index = $('.sasaran-awal-row').length;
        let html = `
        <div class="row sasaran-awal-row mb-3">
            <div class="col-md-5">
                <input type="text" class="form-control" name="sasaran_awal[${index}][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" required>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="sasaran_awal[${index}][petunjuk_prestasi]" placeholder="{{ __('Petunjuk Prestasi (Kuantiti/Kualiti/Masa/Kos)') }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-sasaran-awal"><i class="fas fa-trash"></i></button>
            </div>
            <input type="hidden" name="sasaran_awal[${index}][bahagian]" value="awal">
        </div>`;
        $('#sasaran-awal-container').append(html);
    });

    $(document).on('click', '.remove-sasaran-awal', function() {
        $(this).closest('.sasaran-awal-row').remove();
        reindexFields('.sasaran-awal-row', 'sasaran_awal');
    });

    // Sasaran Tambah Dynamic Fields
    $('#add-sasaran-tambah').click(function() {
        let index = $('.sasaran-tambah-row').length;
        let html = `
        <div class="row sasaran-tambah-row mb-3">
            <div class="col-md-5">
                <input type="text" class="form-control" name="sasaran_tambah[${index}][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" required>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="sasaran_tambah[${index}][petunjuk_prestasi]" placeholder="{{ __('Petunjuk Prestasi (Kuantiti/Kualiti/Masa/Kos)') }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-sasaran-tambah"><i class="fas fa-trash"></i></button>
            </div>
            <input type="hidden" name="sasaran_tambah[${index}][bahagian]" value="pertengahan">
            <input type="hidden" name="sasaran_tambah[${index}][ditambah]" value="1">
        </div>`;
        $('#sasaran-tambah-container').append(html);
    });

    $(document).on('click', '.remove-sasaran-tambah', function() {
        $(this).closest('.sasaran-tambah-row').remove();
        reindexFields('.sasaran-tambah-row', 'sasaran_tambah');
    });

    // Sasaran Gugur Dynamic Fields
    $('#add-sasaran-gugur').click(function() {
        let index = $('.sasaran-gugur-row').length;
        let html = `
        <div class="row sasaran-gugur-row mb-3">
            <div class="col-md-10">
                <input type="text" class="form-control" name="sasaran_gugur[${index}][aktiviti]" placeholder="{{ __('Aktiviti/Projek') }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-sasaran-gugur"><i class="fas fa-trash"></i></button>
            </div>
            <input type="hidden" name="sasaran_gugur[${index}][bahagian]" value="pertengahan">
            <input type="hidden" name="sasaran_gugur[${index}][digugurkan]" value="1">
        </div>`;
        $('#sasaran-gugur-container').append(html);
    });

    $(document).on('click', '.remove-sasaran-gugur', function() {
        $(this).closest('.sasaran-gugur-row').remove();
        reindexFields('.sasaran-gugur-row', 'sasaran_gugur');
    });

    // Helper function to reindex fields
    function reindexFields(selector, prefix) {
        $(selector).each(function(i) {
            $(this).find('input, select').each(function() {
                let name = $(this).attr('name');
                if (name) {
                    let newName = name.replace(new RegExp(`${prefix}\\[\\d+\\]`), `${prefix}[${i}]`);
                    $(this).attr('name', newName);
                }
            });
        });
    }
</script>
@endpush