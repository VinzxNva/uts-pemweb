<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\SewaMobilController;

// ================= RUTE OTENTIKASI (LOGIN & LOGOUT) =================
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= RUTE PROTEKSI (WAJIB LOGIN) =================
Route::middleware(['auth'])->group(function () {
    
    // --- HALAMAN KHUSUS ADMIN ---
    Route::get('/admin/dashboard', [MobilController::class, 'dashboardAdmin']);
    Route::get('/admin/mobil/create', [MobilController::class, 'create'])->name('mobil.create');
    Route::post('/admin/mobil', [MobilController::class, 'store'])->name('mobil.store');
    Route::get('/admin/mobil/{id}/edit', [MobilController::class, 'edit'])->name('mobil.edit');
    Route::put('/admin/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');
    Route::delete('/admin/mobil/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');
    Route::post('/admin/sewa/{id}/selesai', [MobilController::class, 'selesaiSewa'])->name('sewa.selesai'); // Rute Baru
    
    // --- HALAMAN KHUSUS USER / PELANGGAN ---
    Route::get('/user/dashboard', [SewaMobilController::class, 'dashboardUser']);
    Route::post('/user/pembayaran', [SewaMobilController::class, 'tampilkanPembayaran'])->name('sewa.pembayaran');
    Route::post('/user/sewa', [SewaMobilController::class, 'sewa'])->name('sewa.store');
});