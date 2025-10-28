<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\JenisSuratController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//login
Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
Route::resource('user', UserController::class);
Route::resource('warga', WargaController::class);
Route::resource('jenis-surat', JenisSuratController::class);


// Auth Routes (manual karena resource tidak cocok untuk auth)
Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
