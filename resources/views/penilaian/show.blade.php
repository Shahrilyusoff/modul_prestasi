<!-- resources/views/penilaian/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maklumat Penilaian') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                {{ __('BAHAGIAN I - MAKLUMAT PEGAWAI') }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>{{ __('Nama') }}:</strong> {{ $penilaian->pyd->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Jawatan/Gred') }}:</strong> {{ $penilaian->pyd->jawatan }} {{ $penilaian->pyd->gred }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>{{ __('Jabatan') }}:</strong> {{ $penilaian->pyd->jabatan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bahagian II -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                {{ __('BAHAGIAN II - KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI/LATIHAN') }}
            </div>
            <div class="card-body">
                <h5 class="mb-3">1. {{ __('KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI') }}</h5>
                
                @if($penilaian->kegiatanLuar->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50%">{{ __('Kegiatan/Aktiviti/Sumbangan') }}</th>
                                <th>{{ __('Peringkat (Jawatan/Pencapaian)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penilaian->kegiatanLuar as $kegiatan)
                            <tr>
                                <td>{{ $kegiatan->kegiatan }}</td>
                                <td>{{ ucfirst($kegiatan->peringkat) }} @if($kegiatan->jawatan_pencapaian) ({{ $kegiatan->jawatan_pencapaian }}) @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">{{ __('Tiada rekod kegiatan') }}</p>
                @endif

                <h5 class="mt-4 mb-3">2. {{ __('LATIHAN') }}</h5>
                <p>i) {{ __('Latihan yang dihadiri') }}</p>
                
                @if($penilaian->latihan->where('diperlukan', false)->count() > 0)
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="30%">{{ __('Nama Latihan') }}</th>
                                <th width="25%">{{ __('Tarikh/Tempoh') }}</th>
                                <th>{{ __('Tempat') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penilaian->latihan->where('diperlukan', false) as $latihan)
                            <tr>
                                <td>{{ $latihan->nama_latihan }} @if($latihan->sijil) ({{ $latihan->sijil }}) @endif</td>
                                <td>{{ $latihan->tarikh_mula->format('d/m/Y') }} - {{ $latihan->tarikh_tamat->format('d/m/Y') }}</td>
                                <td>{{ $latihan->tempat }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">{{ __('Tiada rekod latihan') }}</p>
                @endif

                <p>ii) {{ __('Latihan yang diperlukan') }}</p>
                
                @if($penilaian->latihan->where('diperlukan', true)->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50%">{{ __('Nama/Bidang Latihan') }}</th>
                                <th>{{ __('Sebab Diperlukan') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penilaian->latihan->where('diperlukan', true) as $latihan)
                            <tr>
                                <td>{{ $latihan->nama_latihan }}</td>
                                <td>{{ $latihan->sebab_diperlukan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">{{ __('Tiada rekod latihan diperlukan') }}</p>
                @endif
            </div>
        </div>

        <!-- Bahagian III-VI -->
        @if($penilaian->status !== 'draf')
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
                                <th>{{ __('PPP') }}</th>
                                <th>{{ __('PPK') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($penilaian->bahagian_iii)
                                @foreach($penilaian->bahagian_iii as $key => $markah)
                                <tr>
                                    <td>{{ App\Helpers\Helpers::getKriteriaLabel('iii', $key) }}</td>
                                    <td>{{ $markah['ppp'] ?? '' }}</td>
                                    <td>{{ $markah['ppk'] ?? '' }}</td>
                                </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td><strong>{{ __('Jumlah markah mengikut wajaran') }}</strong></td>
                                <td>{{ $penilaian->markah_keseluruhan_ppp ? round($penilaian->markah_keseluruhan_ppp * 0.5) : '' }}/50</td>
                                <td>{{ $penilaian->markah_keseluruhan_ppk ? round($penilaian->markah_keseluruhan_ppk * 0.5) : '' }}/50</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Continue with other sections (IV, V, VI) similarly -->
                <!-- ... -->

                <!-- Bahagian VII -->
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN VII - JUMLAH MARKAH KESELURUHAN') }}</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="70%">{{ __('Markah Keseluruhan') }}</th>
                                <th>{{ __('PPP (%)') }}</th>
                                <th>{{ __('PPK (%)') }}</th>
                                <th>{{ __('Markah Purata (%)') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>{{ $penilaian->markah_keseluruhan_ppp ?? '' }}</td>
                                <td>{{ $penilaian->markah_keseluruhan_ppk ?? '' }}</td>
                                <td>{{ $penilaian->markah_purata ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Bahagian VIII - Ulasan PPP -->
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN VIII - ULASAN KESELURUHAN DAN PENGESAHAN OLEH PEGAWAI PENILAI PERTAMA') }}</h5>
                <p>1. {{ __('Tempoh PYD bertugas di bawah pengawasan:') }}</p>
                <p>{{ __('Tahun') }}: {{ $penilaian->tempoh_penilaian_ppp ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppp)->format('Y') : '' }} 
                   {{ __('Bulan') }}: {{ $penilaian->tempoh_penilaian_ppp ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppp)->format('m') : '' }}</p>
                
                <p>2. {{ __('Penilai Pertama hendaklah memberi ulasan keseluruhan prestasi PYD.') }}</p>
                <p>i) {{ __('Prestasi keseluruhan:') }}</p>
                <p>{{ $penilaian->ulasan_ppp ?? '' }}</p>
                
                <p>ii) {{ __('Kemajuan kerjaya:') }}</p>
                <p>[Ulasan kemajuan kerjaya]</p>
                
                <p>3. {{ __('Adalah disahkan bahawa prestasi pegawai ini telah dimaklumkan kepada PYD') }}</p>
                
                <div class="mt-4">
                    <div class="border-top w-50 pt-3">
                        <p>{{ __('Nama PPP') }}: {{ $penilaian->ppp->name ?? '' }}</p>
                        <p>{{ __('Jawatan') }}: {{ $penilaian->ppp->jawatan ?? '' }}</p>
                        <p>{{ __('Kementerian/Jabatan') }}: {{ $penilaian->ppp->jabatan ?? '' }}</p>
                    </div>
                </div>

                <!-- Bahagian IX - Ulasan PPK -->
                @if($penilaian->ppk)
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN IX - ULASAN KESELURUHAN DAN PENGESAHAN OLEH PEGAWAI PENILAI KEDUA') }}</h5>
                <p>1. {{ __('Tempoh PYD bertugas di bawah pengawasan:') }}</p>
                <p>{{ __('Tahun') }}: {{ $penilaian->tempoh_penilaian_ppk ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppk)->format('Y') : '' }} 
                   {{ __('Bulan') }}: {{ $penilaian->tempoh_penilaian_ppk ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppk)->format('m') : '' }}</p>
                
                <p>2. {{ __('PPK hendaklah memberi ulasan keseluruhan pencapaian prestasi PYD berasaskan ulasan keseluruhan oleh PPP') }}</p>
                <p>{{ $penilaian->ulasan_ppk ?? '' }}</p>
                
                <div class="mt-4">
                    <div class="border-top w-50 pt-3">
                        <p>{{ __('Nama PPK') }}: {{ $penilaian->ppk->name ?? '' }}</p>
                        <p>{{ __('Jawatan') }}: {{ $penilaian->ppk->jawatan ?? '' }}</p>
                        <p>{{ __('Kementerian/Jabatan') }}: {{ $penilaian->ppk->jabatan ?? '' }}</p>
                        <p>{{ __('No. K.P.') }}: {{ $penilaian->ppk->no_kp ?? '' }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- SKT -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                {{ __('SASARAN KERJA TAHUNAN') }}
            </div>
            <div class="card-body">
                <!-- Bahagian I - SKT Awal Tahun -->
                <h5 class="mb-3">{{ __('BAHAGIAN I - PENETAPAN SASARAN KERJA TAHUNAN') }}</h5>
                @if($sasaranAwal->count() > 0)
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50%">{{ __('Aktiviti/Projek') }}</th>
                                <th>{{ __('Petunjuk Prestasi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sasaranAwal as $sasaran)
                            <tr>
                                <td>{{ $sasaran->aktiviti }}</td>
                                <td>{{ $sasaran->petunjuk_prestasi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted">{{ __('Tiada rekod sasaran kerja') }}</p>
                @endif

                <!-- Bahagian II - SKT Pertengahan Tahun -->
                @if($sasaranPertengahan->count() > 0)
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN II - KAJIAN SEMULA SASARAN KERJA TAHUNAN PERTENGAHAN TAHUN') }}</h5>
                
                <p>1. {{ __('Aktiviti/Projek Yang Ditambah') }}</p>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50%">{{ __('Aktiviti/Projek') }}</th>
                                <th>{{ __('Petunjuk Prestasi') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sasaranPertengahan->where('ditambah', true) as $sasaran)
                            <tr>
                                <td>{{ $sasaran->aktiviti }}</td>
                                <td>{{ $sasaran->petunjuk_prestasi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p>2. {{ __('Aktiviti/Projek Yang Digugurkan') }}</p>
                <ul>
                    @foreach($sasaranPertengahan->where('digugurkan', true) as $sasaran)
                    <li>{{ $sasaran->aktiviti }}</li>
                    @endforeach
                </ul>
                @endif

                <!-- Bahagian III - SKT Akhir Tahun -->
                @if($sasaranAkhir->count() > 0)
                <h5 class="mt-4 mb-3">{{ __('BAHAGIAN III - LAPORAN DAN ULASAN KESELURUHAN PENCAPAIAN SASARAN KERJA TAHUNAN PADA AKHIR TAHUN OLEH PYD DAN PPP') }}</h5>
                
                <p>1. {{ __('Laporan/Ulasan Oleh PYD') }}</p>
                @foreach($sasaranAkhir as $sasaran)
                    @if($sasaran->ulasan_pyd)
                    <div class="mb-3 p-3 bg-light rounded">
                        <strong>{{ $sasaran->aktiviti }}:</strong>
                        <p>{{ $sasaran->ulasan_pyd }}</p>
                    </div>
                    @endif
                @endforeach

                <p>2. {{ __('Laporan/Ulasan Oleh PPP') }}</p>
                @foreach($sasaranAkhir as $sasaran)
                    @if($sasaran->ulasan_ppp)
                    <div class="mb-3 p-3 bg-light rounded">
                        <strong>{{ $sasaran->aktiviti }}:</strong>
                        <p>{{ $sasaran->ulasan_ppp }}</p>
                    </div>
                    @endif
                @endforeach
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> {{ __('Kembali') }}
            </a>
            
            @if(auth()->user()->role === 'pyd' && $penilaian->status === 'draf')
                <form action="{{ route('penilaian.submit-bahagian-ii', $penilaian->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Adakah anda pasti untuk menghantar Bahagian II?')">
                        <i class="fas fa-paper-plane"></i> {{ __('Hantar Bahagian II') }}
                    </button>
                </form>
            @endif
            
            @if((auth()->user()->role === 'ppp' && $penilaian->status === 'penilaian_ppp') || 
                (auth()->user()->role === 'ppk' && $penilaian->status === 'penilaian_ppk'))
                <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> {{ __('Lengkapkan Penilaian') }}
                </a>
            @endif
        </div>
    </div>
</x-app-layout>