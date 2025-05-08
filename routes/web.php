<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TempohPenilaianController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('penilaian/pyd', [PenilaianController::class, 'pyd'])->name('penilaian.pyd');
    Route::post('penilaian/{penilaian}/submit-bahagian-ii', [PenilaianController::class, 'submitBahagianII'])
        ->name('penilaian.submit-bahagian-ii');

    // Laporan routes
    Route::get('laporan/penilaian/{penilaian}', [LaporanController::class, 'penilaian'])
        ->name('laporan.penilaian');
    Route::get('laporan/skt/{penilaian}', [LaporanController::class, 'skt'])
        ->name('laporan.skt');
});

require __DIR__.'/auth.php';
