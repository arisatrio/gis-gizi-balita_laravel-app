<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\DashboardMapController;
use App\Http\Controllers\Admin\DashboardAnalyticsController;

use App\Http\Controllers\Admin\CheckUpController;
use App\Http\Controllers\Admin\BalitaCheckUpController;
use App\Http\Controllers\Admin\BalitaController;
use App\Http\Controllers\Admin\PosyanduController;
use App\Http\Controllers\Admin\RukunWargaController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\DownloadTemplateLokasiController;
use App\Http\Controllers\Admin\DataTrainingController;
use App\Http\Controllers\Admin\DataNormalisasiController;
use App\Http\Controllers\Admin\GenerateNormalisasiController;

use App\Http\Controllers\BalitaSayaController;
use App\Http\Controllers\BalitaSayaRiwayatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class);

Route::group(['as' => 'admin.', 'middleware' => 'auth'], function () {
    //DASHBAORD
    Route::get('/dashboard-map', DashboardMapController::class)->name('dashboard-map');
    Route::get('/dashboard', DashboardAnalyticsController::class)->name('dashboard');

    Route::get('/data-balita/{id}/check-up', [BalitaCheckUpController::class, 'create'])->name('balita-checkup.create');
    Route::post('/data-balita/check-up', [BalitaCheckUpController::class, 'store'])->name('balita-checkup.store');
    Route::get('/data-balita/{id}/riwayat-check-up', [BalitaCheckUpController::class, 'show'])->name('balita-checkup.show');
    Route::resource('data-check-up', CheckUpController::class)->except(['create', 'store', 'show']);

    Route::resources([
        'data-balita'       => BalitaController::class,
        'data-posyandu'     => PosyanduController::class,
        'data-rw'           => RukunWargaController::class,
        'data-lokasi'       => LokasiController::class,
        'data-pengguna'     => PenggunaController::class,
        'data-training'     => DataTrainingController::class,
        'data-normalisasi'  => DataNormalisasiController::class,
    ], [ 'except' => 'show' ]);
    Route::get('/download-template-lokasi', DownloadTemplateLokasiController::class)->name('download-geojson');
    Route::get('/data-normalisasi/generate-normalisasi', GenerateNormalisasiController::class)->name('generate-normalisasi');
});

Route::group(['as' => 'user.', 'middleware' => ['auth', 'masyarakat']], function () {
    Route::resource('balita-saya', BalitaSayaController::class);
});


require __DIR__.'/auth.php';
