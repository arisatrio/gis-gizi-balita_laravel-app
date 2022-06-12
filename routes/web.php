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
use App\Http\Controllers\Admin\DownloadTemplateLokasiController;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {


    Route::get('/data-balita/{id}/check-up', [BalitaCheckUpController::class, 'create'])->name('balita-checkup.create');
    Route::post('/data-balita/check-up', [BalitaCheckUpController::class, 'store'])->name('balita-checkup.store');
    Route::get('/data-balita/{id}/riwayat-check-up', [BalitaCheckUpController::class, 'show'])->name('balita-checkup.show');
    Route::resource('data-check-up', CheckUpController::class)->except(['create', 'store', 'show']);
    Route::resources([
        'data-balita'       => BalitaController::class,
        'data-posyandu'     => PosyanduController::class,
        'data-rw'           => RukunWargaController::class,
        'data-lokasi'       => LokasiController::class,
    ], [ 'except' => 'show' ]);
    Route::get('download-template-lokasi', DownloadTemplateLokasiController::class)->name('download-geojson');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
