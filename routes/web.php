<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Controllers;
use Illuminate\Support\Facades\Route;

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


    Route::get('/', [UserController::class, 'index'])->name('landing');
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
    Route::get('/laporann/{siapa?}', [UserController::class, 'laporan'])->name('pekat.laporan');



    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return view('Dashboards.dash');
        });

        // Rute untuk semua pengguna yang telah login
        Route::resource('users', UserController::class);

        // Rute yang hanya dapat diakses oleh admin
    Route::middleware(['admin'])->group(function () {
        Route::resource('petugas', PetugasController::class);
        Route::post('Laporan', [LaporanController::class, 'Laporan'])->name('laporan.index');

        Route::resource('masyarakat', MasyarakatController::class);

        });

        // Rute yang hanya dapat diakses oleh admin atau petugas
        Route::middleware(['admin', 'petugas'])->group(function () {


        });
        // Rute pengaduan yang dapat diakses oleh admin atau petugas
        Route::resource('pengaduan', PengaduanController::class);
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('getLaporan', [LaporanController::class, 'getLaporan'])->name('laporan.getLaporan');
        Route::get('laporan/cetak/{from}/{to}', [LaporanController::class, 'cetaklaporan'])->name('laporan.cetaklaporan');

        Route::delete('/tanggapan/{tanggapan}', [TanggapanController::class, 'destroy']);
        Route::post('createOrUpdate/{tanggapan_id?}', [TanggapanController::class, 'createOrUpdate'])->name('tanggapan.createOrUpdate');
        // Route untuk membuat tanggapan baru
        Route::post('/tanggapan/create', [TanggapanController::class, 'create'])->name('tanggapan.create');

        // Route untuk mengedit tanggapan yang ada
        Route::put('/tanggapan/{tanggapan}', [TanggapanController::class, 'update'])->name('tanggapan.update');


    });




