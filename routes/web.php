<?php

use App\Http\Controllers\Admin\BiodataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dahsboard\CampaignController;
use App\Http\Controllers\Dashboard\AgendaController;
use App\Http\Controllers\Dashboard\AlumniController;
use App\Http\Controllers\Dashboard\AlumniMasterController;
use App\Http\Controllers\Dashboard\BeritaController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GaleriController;
use App\Http\Controllers\Dashboard\PemasukanController;
use App\Http\Controllers\Dashboard\PengeluaranController;
use App\Http\Controllers\Dashboard\PenggunaController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', [PublicController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// campaign donasi route
Route::prefix('campaign')->name('campaign.')->controller(PublicController::class)->group(function () {
    Route::get('/', 'donasiIndex')->name('index');
    Route::get('/{slug}', 'donasiShow')->name('show');
    Route::get('/form/{campaign}', 'donasiCreate')->name('form');
    Route::post('/donasi/kirim', 'donasiKirim')->name('donasi.store');
    Route::get('/riwayat/{campaign}', 'donasiRiwayat')->name('riwayat');
    Route::get('/doa/{campaign}', 'doaRiwayat')->name('doa.riwayat');
    Route::post('/doa/kirim', 'doaKirim')->name('doa.store');
});

// agenda route
Route::prefix('agenda')->name('agenda.')->controller(PublicController::class)->group(function () {
    Route::get('/', 'agendaIndex')->name('index');
    Route::get('/{slug}', 'agendaShow')->name('show');
});
// berita route
Route::prefix('berita')->name('berita.')->controller(PublicController::class)->group(function () {
    Route::get('/', 'beritaIndex')->name('index');
    Route::get('/{slug}', 'beritaShow')->name('show');
});

Route::prefix('alumni')->name('alumni.')->controller(PublicController::class)->group(function () {
    Route::get('/', 'alumniIndex')->name('publik');
    Route::post('/cek', 'cekData')->name('cekdata');
    Route::get('/cek/form','cekForm')->name('cekform');
    Route::post('/simpan', 'simpanAlumni')->name('simpan');
    Route::get('/{id}/detail', 'alumniShow')->name('show');
});
// galeri
Route::prefix('galeri')->name('galeri.')->controller(PublicController::class)->group(function () {
    Route::get('/', 'galeriIndex')->name('index');
    Route::get('/ajax', 'ajax')->name('ajax');
});

Route::get('/profil', [PublicController::class, 'profilIndex'])->name('profil.index');

// operator route
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->name('operator.dashboard.')->group(function () {
    Route::get('/admin/operator', [DashboardController::class, 'dashboardOperator'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':bendahara'])->name('bendahara.dashboard.')->group(function () {
    Route::get('/admin/bendahara', [DashboardController::class, 'dashboardBendahara'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':sekretaris'])->name('sekretaris.dashboard.')->group(function () {
    Route::get('/admin/sekretaris', [DashboardController::class, 'dashboardSekretaris'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':media'])->name('media.dashboard.')->group(function () {
    Route::get('/media/media', [DashboardController::class, 'dashboardMedia'])->name('index');
});

Route::middleware(['auth', RoleMiddleware::class . ':alumni'])->name('alumni.dashboard.')->group(function () {
    Route::get('/alumni/dashboard', [DashboardController::class, 'dashboardAlumni'])->name('index');
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
        Route::get('/import', 'alumniMasterImport')->name('import');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import.save');
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
        Route::get('/import', 'alumniImport')->name('import');
        Route::get('/export', 'export')->name('export');
        Route::post('/import', 'import')->name('import.save');
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

// berita
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(BeritaController::class)->prefix('berita')->name('berita.')->group(function () {
        Route::get('/', 'beritaIndex')->name('index');
        Route::get('/tambah', 'beritaCreate')->name('create');
        Route::post('/', 'beritaStore')->name('store');
        Route::get('/{slug}/edit', 'beritaEdit')->name('edit');
        Route::put('/{slug}', 'beritaUpdate')->name('update');
        Route::delete('/{slug}', 'beritaDestroy')->name('destroy');
    });
});

// donasi
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(CampaignController::class)->prefix('campaign')->name('campaign.')->group(function () {
        Route::get('/', 'campaignIndex')->name('index');
        Route::get('/tambah', 'campaignCreate')->name('create');
        Route::post('/', 'campaignStore')->name('store');
        Route::get('/{campaign}/edit', 'campaignEdit')->name('edit');
        Route::get('/{campaign}/detail', 'campaignShow')->name('show');
        Route::put('/{campaign}', 'campaignUpdate')->name('update');
        Route::put('/{id}/verifikasi', 'campaignVerifikasi')->name('verifikasi');
        Route::put('/{id}/tolak', 'campaignTolak')->name('tolak');
        Route::delete('/{campaign}', 'campaignDestroy')->name('destroy');
    });
});

// galeri
Route::middleware(['auth', RoleMiddleware::class . ':operator'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(GaleriController::class)->prefix('galeri')->name('galeri.')->group(function () {
        Route::get('/', 'galeriIndex')->name('index');
        Route::get('/tambah', 'galeriCreate')->name('create');
        Route::post('/', 'galeriStore')->name('store');
        Route::get('/{galeri}/edit', 'galeriEdit')->name('edit');
        Route::put('/{galeri}', 'galeriUpdate')->name('update');
        Route::delete('/{galeri}', 'galeriDestroy')->name('destroy');
        Route::delete('/galeri/foto/{foto}', 'galeriFotoDestroy')->name('hapus');
        Route::get('/{galeri}', 'galeriShow')->name('show');
    });
});

Route::middleware(['auth', RoleMiddleware::class . ':alumni'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(BiodataController::class)->prefix('biodata')->name('biodata.')->group(function () {
        Route::get('/', 'biodataEdit')->name('edit');
        Route::put('/{id}/update', 'biodataUpdate')->name('update');
    });
});
