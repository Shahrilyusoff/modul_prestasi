<?php

// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TempohPenilaianController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User management (only for admin/superadmin)
    Route::middleware(['can:manage-users'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Tempoh Penilaian routes
    Route::resource('tempoh-penilaian', TempohPenilaianController::class)->except(['show']);
    Route::post('tempoh-penilaian/{tempohPenilaian}/aktifkan', [TempohPenilaianController::class, 'aktifkan'])
        ->name('tempoh-penilaian.aktifkan');

    // Penilaian routes
    Route::resource('penilaian', PenilaianController::class);
    Route::get('penilaian/pyd', [PenilaianController::class, 'pyd'])
        ->name('penilaian.pyd')
        ->middleware('auth');

    // Laporan routes
    Route::get('laporan/penilaian/{penilaian}', [LaporanController::class, 'penilaian'])
        ->name('laporan.penilaian');
    Route::get('laporan/skt/{penilaian}', [LaporanController::class, 'skt'])
        ->name('laporan.skt');
});

require __DIR__.'/auth.php';
