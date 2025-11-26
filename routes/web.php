<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataMitraController;
use App\Http\Controllers\PerjanjianSewaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DashboardController;


// ======================================================
// DASHBOARD
// ======================================================
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home/beranda', [DashboardController::class, 'index'])->name('dashboard');


// ======================================================
// LAPORAN
// ======================================================
Route::get('/laporan', [DashboardController::class, 'laporan'])->name('laporan.index');
Route::get('/laporan/download', [DashboardController::class, 'downloadPdf'])->name('laporan.download');


// ======================================================
// PENDAFTARAN MITRA
// ======================================================
Route::get('pendaftaran/form_data_diri', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
Route::post('pendaftaran/create', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::get('pendaftaran/list_data', [PerjanjianSewaController::class, 'perjanjian_sewa'])->name('pendaftaran.list');
Route::get('pendaftaran/list_perjanjian/{id_perjanjian}', [PerjanjianSewaController::class, 'edit'])->name('pendaftaran.edit');
Route::post('pendaftaran/update/{id_perjanjian}', [PerjanjianSewaController::class, 'update'])->name('pendaftaran.update');

Route::get('pendaftaran/perjanjian_dokumen/{id_perjanjian}', [PerjanjianSewaController::class, 'showPerjanjianDokumen'])->name('pendaftaran.perjanjian_dokumen');

Route::get('perjanjian/preview/{id_perjanjian}', [PerjanjianSewaController::class, 'previewPerjanjianPDF'])->name('perjanjian.preview');

Route::get('pendaftaran/list_perjanjian', [HomeController::class, 'list_perjanjian'])->name('menu.list_perjanjian');
Route::get('pendaftaran/perjanjian_event', [HomeController::class, 'perjanjian'])->name('menu.perjanjian_event');


// ======================================================
// PERPANJANGAN KONTRAK
// ======================================================

// tabel data perpanjang
Route::get('/perpanjang', [PerjanjianSewaController::class, 'indexPerpanjang'])
    ->name('perpanjang.index');

// form perpanjang
Route::get('/perpanjang/{id}', [PerjanjianSewaController::class, 'formPerpanjang'])
    ->name('perpanjang.form');

// simpan perpanjang
Route::post('/perpanjang/{id}', [PerjanjianSewaController::class, 'storePerpanjang'])
    ->name('perpanjang.store');

