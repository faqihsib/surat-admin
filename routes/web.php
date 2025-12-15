<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\PermohonanSuratController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//auth (login & logout)
Route::get('/', [AuthController::class, 'index'])->name('auth.index');
//Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
//Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//
//Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
// Route::resource('user', UserController::class);
// Route::resource('warga', WargaController::class);
// Route::resource('jenis-surat', JenisSuratController::class);
// Route::resource('permohonan-surat', PermohonanSuratController::class);


// Auth Routes (manual karena resource tidak cocok untuk auth)
Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/about', [AdminController::class, 'about'])->name('admin.about');

//untuk multiupload files
//Route::delete('/upload/delete/{id}', [PermohonanSuratController::class, 'deleteFile'])->name('uploads.delete');


//middleware
Route::group(['middleware' => ['checkislogin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    // 1. ROLE: SUPERADMIN
    // Hanya Superadmin yang bisa kelola User:
    Route::group(['middleware' => ['checkrole:superadmin']], function () {
        Route::resource('users', UserController::class);
        Route::delete('/users/foto/{id}', [UserController::class, 'deleteFoto'])->name('users.delete_foto');
    });
    // 2. ROLE: STAFF (dan Superadmin)
    // Staff bisa Create, Edit, Update, Delete data Warga, Jenis Surat, Permohonan
    // Guest TIDAK BISA akses route ini
    Route::group(['middleware' => ['checkrole:staff']], function () {
        Route::resource('warga', WargaController::class)->except(['index', 'show']);
        Route::resource('jenis-surat', JenisSuratController::class)->except(['index', 'show']);
        Route::resource('permohonan-surat', PermohonanSuratController::class)->except(['index', 'show']);
        Route::resource('berkas', BerkasController::class);
        Route::resource('riwayat', RiwayatController::class);
        Route::get('permohonan-surat/download/{id}', [PermohonanSuratController::class, 'downloadFile'])
        ->name('permohonan-surat.download');
        Route::delete('/permohonan-surat/delete-file/{id}', [PermohonanSuratController::class, 'deleteFile'])->name('uploads.delete');
    });
    // 3. SEMUA ROLE (Termasuk Guest)
    // Guest hanya bisa melihat data (Index dan Show)
    Route::resource('warga', WargaController::class)->only(['index', 'show']);
    Route::resource('jenis-surat', JenisSuratController::class)->only(['index', 'show']);
    Route::resource('permohonan-surat', PermohonanSuratController::class)->only(['index', 'show']);
    Route::resource('berkas', BerkasController::class);
    Route::resource('riwayat', RiwayatController::class);
});
