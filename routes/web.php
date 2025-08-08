<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\AgendaController;
use App\Http\Controllers\Dashboard\AlumniController;
use App\Http\Controllers\Dashboard\AlumniMasterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\OperatorController;
use App\Http\Controllers\Dashboard\PemasukanController;
use App\Http\Controllers\Dashboard\PengeluaranController;
use App\Http\Controllers\Dashboard\PenggunaController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(PublicController::class)->prefix('data/alumni')->name('alumni.')->group(function () {
    Route::get('/cek','cekForm')->name('cekform');
    Route::post('/cek', 'cekData')->name('cekdata');
    Route::post('/simpan', 'simpanAlumni')->name('simpan');
});

// operator route
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('operator.dashboard.')->group(function () {
    Route::get('/operator', [DashboardController::class, 'dashboardOperator'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':bendahara'])->prefix('admin')->name('bendahara.dashboard.')->group(function () {
    Route::get('/bendahara', [DashboardController::class, 'dashboardBendahara'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':sekretaris'])->prefix('admin')->name('sekretaris.dashboard.')->group(function () {
    Route::get('/sekretaris', [DashboardController::class, 'dashboardSekretaris'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':media'])->prefix('admin')->name('media.dashboard.')->group(function () {
    Route::get('/media', [DashboardController::class, 'dashboardMedia'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':alumni'])->prefix('user')->name('alumni.dashboard.')->group(function () {
    Route::get('/alumni', [DashboardController::class, 'dashboardAlumni'])->name('index');
});

// pemasukan route
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(PemasukanController::class)->prefix('pemasukan')->name('pemasukan.')->group(function () {
        Route::get('/', 'pemasukanIndex')->name('index');
        Route::get('/tambah', 'pemasukanCreate')->name('create');
        Route::post('/', 'pemasukanStore')->name('store');
        Route::get('/{pemasukan}/edit', 'pemasukanEdit')->name('edit');
        Route::put('/{pemasukan}', 'pemasukanUpdate')->name('update');
        Route::delete('/{pemasukan}', 'pemasukanDestroy')->name('destroy');
    });
});

// pengeluaran route
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(PengeluaranController::class)->prefix('pengeluaran')->name('pengeluaran.')->group(function () {
        Route::get('/', 'pengeluaranIndex')->name('index');
        Route::get('/tambah', 'pengeluaranCreate')->name('create');
        Route::post('/', 'pengeluaranStore')->name('store');
        Route::get('/{id}/edit', 'pengeluaranEdit')->name('edit');
        Route::put('/{id}', 'pengeluaranUpdate')->name('update');
        Route::delete('/{id}', 'pengeluaranDestroy')->name('destroy');
    });
});

// master alumni route
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AlumniMasterController::class)->prefix('master/alumni')->name('alumnimaster.')->group(function () {
        Route::get('/', 'alumnimasterIndex')->name('index');
        Route::get('/tambah', 'alumnimasterCreate')->name('create');
        Route::post('/', 'alumnimasterStore')->name('store');
        Route::get('/{id}/edit', 'alumnimasterEdit')->name('edit');
        Route::put('/{id}', 'alumnimasterUpdate')->name('update');
        Route::delete('/{id}', 'alumnimasterDestroy')->name('destroy');
    });
});

// alumni route
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AlumniController::class)->prefix('alumni')->name('alumni.')->group(function () {
        Route::get('/', 'alumniIndex')->name('index');
        Route::get('/export', 'alumniIndex')->name('export');
        Route::get('/tambah', 'alumniCreate')->name('create');
        Route::post('/', 'alumniStore')->name('store');
        Route::get('/{alumni}/edit', 'alumniEdit')->name('edit');
        Route::put('/{alumni}', 'alumniUpdate')->name('update');
        Route::delete('/{alumni}', 'alumniDestroy')->name('destroy');
        Route::get('/{alumni}', 'alumniShow')->name('show');
    });
});


// pengguna sistem
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(PenggunaController::class)->prefix('pengguna')->name('pengguna.')->group(function () {
        Route::get('/', 'penggunaIndex')->name('index');
        Route::get('/tambah', 'penggunaCreate')->name('create');
        Route::post('/', 'penggunaStore')->name('store');
        Route::get('/{user}/edit', 'penggunaEdit')->name('edit');
        Route::put('/{user}', 'penggunaUpdate')->name('update');
        Route::delete('/{user}', 'penggunaDestroy')->name('destroy');
    });
});

// agenda
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AgendaController::class)->prefix('agenda')->name('agenda.')->group(function () {
        Route::get('/', 'agendaIndex')->name('index');
        Route::get('/tambah', 'agendaCreate')->name('create');
        Route::post('/', 'agendaStore')->name('store');
        Route::get('/{agenda}/edit', 'agendaEdit')->name('edit');
        Route::put('/{agenda}', 'agendaUpdate')->name('update');
        Route::delete('/{agenda}', 'agendaDestroy')->name('destroy');
        Route::get('/{agenda}', 'agendaShow')->name('show');
    });
});
