<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\GradingController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\KGBController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;


// Route untuk autentikasi
Route::get('/', function () {
    // Redirect ke halaman dashboard jika sudah login
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    // Jika belum login, redirect ke halaman login
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pegawai
    Route::resource('pegawai', PegawaiController::class);

    // Info Pegawai
    Route::get('/info-pegawai/grading', [GradingController::class, 'index'])->name('grading.index');
    Route::get('/info-pegawai/pangkat', [PangkatController::class, 'index'])->name('pangkat.index');
    Route::get('/info-pegawai/kgb', [KGBController::class, 'index'])->name('kgb.index');

    // Monitoring
    Route::middleware(['auth'])->group(function () {
    // Monitoring routes
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::post('/monitoring/update-status', [MonitoringController::class, 'updateStatus'])->name('monitoring.updateStatus');
    Route::get('/monitoring/get-note/{nip}/{jenis_info}', [MonitoringController::class, 'getNote'])->name('monitoring.getNote');
    Route::get('/monitoring/export/{type}', [MonitoringController::class, 'exportCsv'])->name('monitoring.export');
});
    
    // Manajemen User (hanya untuk admin)
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    
    
});
