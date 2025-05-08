<?php

// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    // Tempoh Penilaian
    Route::apiResource('tempoh-penilaian', \App\Http\Controllers\TempohPenilaianController::class);
    Route::post('tempoh-penilaian/{tempohPenilaian}/aktifkan', [\App\Http\Controllers\TempohPenilaianController::class, 'aktifkan']);
    
    // Penilaian
    Route::apiResource('penilaian', \App\Http\Controllers\PenilaianController::class);
    Route::post('penilaian/{penilaian}/submit-bahagian-ii', [\App\Http\Controllers\PenilaianController::class, 'submitBahagianII']);
    
    // Sasaran Kerja
    Route::apiResource('penilaian.sasaran-kerja', \App\Http\Controllers\SasaranKerjaController::class)->shallow();
    Route::post('sasaran-kerja/{sasaranKerja}/sahkan', [\App\Http\Controllers\SasaranKerjaController::class, 'sahkan']);
    
    // Kegiatan Luar
    Route::apiResource('penilaian.kegiatan-luar', \App\Http\Controllers\KegiatanLuarController::class)->shallow();
    
    // Latihan
    Route::apiResource('penilaian.latihan', \App\Http\Controllers\LatihanController::class)->shallow();
    
    // Laporan
    Route::get('laporan/penilaian/{penilaian}', [\App\Http\Controllers\LaporanController::class, 'penilaian']);
    Route::get('laporan/skt/{penilaian}', [\App\Http\Controllers\LaporanController::class, 'skt']);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
