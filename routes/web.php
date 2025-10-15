<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisSuratController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin', [AdminController::class, 'index']);

//login
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/store', [AuthController::class, 'store'])->name('auth.store');

// Route untuk dashboard admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

// Admin Dashboard
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Data Warga - Routes Sederhana
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/tambah', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::post('/warga/{id}/update', [WargaController::class, 'update'])->name('warga.update');
Route::get('/warga/{id}/hapus', [WargaController::class, 'destroy'])->name('warga.destroy');

// Jenis Surat - Routes Sederhana
Route::get('/jenis-surat', [JenisSuratController::class, 'index'])->name('jenis-surat.index');
Route::get('/jenis-surat/tambah', [JenisSuratController::class, 'create'])->name('jenis-surat.create');
Route::post('/jenis-surat', [JenisSuratController::class, 'store'])->name('jenis-surat.store');
Route::get('/jenis-surat/{id}/edit', [JenisSuratController::class, 'edit'])->name('jenis-surat.edit');
Route::post('/jenis-surat/{id}/update', [JenisSuratController::class, 'update'])->name('jenis-surat.update');
Route::get('/jenis-surat/{id}/hapus', [JenisSuratController::class, 'destroy'])->name('jenis-surat.destroy');
