// resources/views/laporan/penilaian.blade.php

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penilaian Prestasi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { margin-top: 50px; }
        .signature { width: 300px; border-top: 1px solid #000; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INSTITUT KOPERASI MALAYSIA</h2>
        <h3>LAPORAN PENILAIAN PRESTASI</h3>
        <p>Tahun: {{ $penilaian->tempohPenilaian->nama_tempoh }}</p>
    </div>

    <!-- Bahagian I - Maklumat Pegawai -->
    <h4>BAHAGIAN I - MAKLUMAT PEGAWAI</h4>
    <table>
        <tr>
            <td width="30%">Nama</td>
            <td>{{ $penilaian->pyd->name }}</td>
        </tr>
        <tr>
            <td>Jawatan dan Gred</td>
            <td>{{ $penilaian->pyd->jawatan }} {{ $penilaian->pyd->gred }}</td>
        </tr>
        <tr>
            <td>Kementerian/Jabatan</td>
            <td>{{ $penilaian->pyd->jabatan }}</td>
        </tr>
    </table>

    <!-- Bahagian II - Kegiatan dan Sumbangan -->
    <h4 style="margin-top: 20px;">BAHAGIAN II - KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI/LATIHAN</h4>
    
    <p>1. KEGIATAN DAN SUMBANGAN DI LUAR TUGAS RASMI</p>
    <table>
        <tr>
            <th width="50%">Kegiatan/Aktiviti/Sumbangan</th>
            <th>Peringkat (Jawatan/Pencapaian)</th>
        </tr>
        @foreach($penilaian->kegiatanLuar as $kegiatan)
        <tr>
            <td>{{ $kegiatan->kegiatan }}</td>
            <td>{{ ucfirst($kegiatan->peringkat) }} @if($kegiatan->jawatan_pencapaian) ({{ $kegiatan->jawatan_pencapaian }}) @endif</td>
        </tr>
        @endforeach
    </table>

    <p style="margin-top: 20px;">2. LATIHAN</p>
    <p>i) Latihan yang dihadiri</p>
    <table>
        <tr>
            <th width="30%">Nama Latihan</th>
            <th width="25%">Tarikh/Tempoh</th>
            <th>Tempat</th>
        </tr>
        @foreach($penilaian->latihan->where('diperlukan', false) as $latihan)
        <tr>
            <td>{{ $latihan->nama_latihan }} @if($latihan->sijil) ({{ $latihan->sijil }}) @endif</td>
            <td>{{ $latihan->tarikh_mula->format('d/m/Y') }} - {{ $latihan->tarikh_tamat->format('d/m/Y') }}</td>
            <td>{{ $latihan->tempat }}</td>
        </tr>
        @endforeach
    </table>

    <p style="margin-top: 20px;">ii) Latihan yang diperlukan</p>
    <table>
        <tr>
            <th width="50%">Nama/Bidang Latihan</th>
            <th>Sebab Diperlukan</th>
        </tr>
        @foreach($penilaian->latihan->where('diperlukan', true) as $latihan)
        <tr>
            <td>{{ $latihan->nama_latihan }}</td>
            <td>{{ $latihan->sebab_diperlukan }}</td>
        </tr>
        @endforeach
    </table>

    <!-- Bahagian III-VI - Penilaian -->
    <h4 style="margin-top: 20px;">BAHAGIAN III - PENGHASILAN KERJA (Wajaran 50%)</h4>
    <table>
        <tr>
            <th width="70%">Kriteria</th>
            <th>PPP</th>
            <th>PPK</th>
        </tr>
        @if($penilaian->bahagian_iii)
            @foreach($penilaian->bahagian_iii as $key => $markah)
            <tr>
                <td>{{ $this->getKriteriaLabel('iii', $key) }}</td>
                <td>{{ $markah['ppp'] ?? '' }}</td>
                <td>{{ $markah['ppk'] ?? '' }}</td>
            </tr>
            @endforeach
        @endif
        <tr>
            <td><strong>Jumlah markah mengikut wajaran</strong></td>
            <td>{{ $penilaian->markah_keseluruhan_ppp ? round($penilaian->markah_keseluruhan_ppp * 0.5) : '' }}/50</td>
            <td>{{ $penilaian->markah_keseluruhan_ppk ? round($penilaian->markah_keseluruhan_ppk * 0.5) : '' }}/50</td>
        </tr>
    </table>

    <!-- Continue with other sections (IV, V, VI) similarly -->
    <!-- ... -->

    <!-- Bahagian VII - Jumlah Markah -->
    <h4 style="margin-top: 20px;">BAHAGIAN VII - JUMLAH MARKAH KESELURUHAN</h4>
    <table>
        <tr>
            <th width="70%">Markah Keseluruhan</th>
            <th>PPP (%)</th>
            <th>PPK (%)</th>
            <th>Markah Purata (%)</th>
        </tr>
        <tr>
            <td></td>
            <td>{{ $penilaian->markah_keseluruhan_ppp ?? '' }}</td>
            <td>{{ $penilaian->markah_keseluruhan_ppk ?? '' }}</td>
            <td>{{ $penilaian->markah_purata ?? '' }}</td>
        </tr>
    </table>

    <!-- Bahagian VIII - Ulasan PPP -->
    <h4 style="margin-top: 20px;">BAHAGIAN VIII - ULASAN KESELURUHAN DAN PENGESAHAN OLEH PEGAWAI PENILAI PERTAMA</h4>
    <p>1. Tempoh PYD bertugas di bawah pengawasan:</p>
    <p>Tahun: {{ $penilaian->tempoh_penilaian_ppp ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppp)->format('Y') : '' }} 
       Bulan: {{ $penilaian->tempoh_penilaian_ppp ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppp)->format('m') : '' }}</p>
    
    <p>2. Penilai Pertama hendaklah memberi ulasan keseluruhan prestasi PYD.</p>
    <p>i) Prestasi keseluruhan:</p>
    <p>{{ $penilaian->ulasan_ppp ?? '' }}</p>
    
    <p>ii) Kemajuan kerjaya:</p>
    <p>[Ulasan kemajuan kerjaya]</p>
    
    <p>3. Adalah disahkan bahawa prestasi pegawai ini telah dimaklumkan kepada PYD</p>
    
    <div class="footer">
        <div class="signature">
            <p>Nama PPP: {{ $penilaian->ppp->name ?? '' }}</p>
            <p>Jawatan: {{ $penilaian->ppp->jawatan ?? '' }}</p>
            <p>Kementerian/Jabatan: {{ $penilaian->ppp->jabatan ?? '' }}</p>
        </div>
    </div>

    <!-- Bahagian IX - Ulasan PPK -->
    @if($penilaian->ppk)
    <h4 style="margin-top: 50px;">BAHAGIAN IX - ULASAN KESELURUHAN DAN PENGESAHAN OLEH PEGAWAI PENILAI KEDUA</h4>
    <p>1. Tempoh PYD bertugas di bawah pengawasan:</p>
    <p>Tahun: {{ $penilaian->tempoh_penilaian_ppk ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppk)->format('Y') : '' }} 
       Bulan: {{ $penilaian->tempoh_penilaian_ppk ? \Carbon\Carbon::parse($penilaian->tempoh_penilaian_ppk)->format('m') : '' }}</p>
    
    <p>2. PPK hendaklah memberi ulasan keseluruhan pencapaian prestasi PYD berasaskan ulasan keseluruhan oleh PPP</p>
    <p>{{ $penilaian->ulasan_ppk ?? '' }}</p>
    
    <div class="footer">
        <div class="signature">
            <p>Nama PPK: {{ $penilaian->ppk->name ?? '' }}</p>
            <p>Jawatan: {{ $penilaian->ppk->jawatan ?? '' }}</p>
            <p>Kementerian/Jabatan: {{ $penilaian->ppk->jabatan ?? '' }}</p>
            <p>No. K.P.: {{ $penilaian->ppk->no_kp ?? '' }}</p>
        </div>
    </div>
    @endif
</body>
</html>