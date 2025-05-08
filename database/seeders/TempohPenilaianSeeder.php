<?php

// database/seeders/TempohPenilaianSeeder.php

namespace Database\Seeders;

use App\Models\TempohPenilaian;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TempohPenilaianSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        TempohPenilaian::create([
            'nama_tempoh' => 'Penetapan SKT Awal Tahun 2025',
            'tarikh_mula' => $now->copy()->startOfYear(),
            'tarikh_tamat' => $now->copy()->startOfYear()->addMonth(),
            'jenis' => 'sasaran_awal',
            'aktif' => false
        ]);
        
        TempohPenilaian::create([
            'nama_tempoh' => 'Kajian Semula SKT Pertengahan Tahun 2025',
            'tarikh_mula' => $now->copy()->month(6)->startOfMonth(),
            'tarikh_tamat' => $now->copy()->month(6)->endOfMonth(),
            'jenis' => 'pertengahan',
            'aktif' => false
        ]);
        
        TempohPenilaian::create([
            'nama_tempoh' => 'Penilaian Prestasi Akhir Tahun 2025',
            'tarikh_mula' => $now->copy()->month(11)->startOfMonth(),
            'tarikh_tamat' => $now->copy()->endOfYear(),
            'jenis' => 'akhir',
            'aktif' => true
        ]);
    }
}
