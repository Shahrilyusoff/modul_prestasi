<?php

// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function penilaian(Penilaian $penilaian)
    {
        $this->authorize('view', $penilaian);
        
        $penilaian->load(['pyd', 'ppp', 'ppk', 'tempohPenilaian', 'sasaranKerja', 'kegiatanLuar', 'latihan']);
        
        $pdf = Pdf::loadView('laporan.penilaian', compact('penilaian'));
        return $pdf->download('laporan-penilaian-' . $penilaian->pyd->name . '.pdf');
    }

    public function skt(Penilaian $penilaian)
    {
        $this->authorize('view', $penilaian);
        
        $penilaian->load(['pyd', 'ppp', 'sasaranKerja']);
        
        $pdf = Pdf::loadView('laporan.skt', compact('penilaian'));
        return $pdf->download('sasaran-kerja-tahunan-' . $penilaian->pyd->name . '.pdf');
    }
}