<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataMitraController;
use App\Http\Controllers\PerjanjianSewaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PerpanjangController;
use App\Http\Controllers\DashboardController;

Route::get("pendaftaran/form_data_diri", [HomeController::class, "form_pendaftaran"])->name('home');
Route::get("pendaftaran/list_data", [HomeController::class, "list_data"])->name('home');
Route::get("pendaftaran/perjanjian_event", [HomeController::class, "perjanjian"])->name('home');
Route::get("list_data_perjanjian/data_perjanjian", [HomeController::class, "data_perjanjian"])->name('home');

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

// halaman list perpanjang
Route::get('/perpanjang', [PerpanjangController::class, 'index'])
    ->name('perpanjang.index');

// FORM STEP 1 - tampilkan data perjanjian
Route::get('/perpanjang/form/{id}', [PerpanjangController::class, 'form'])
    ->name('perpanjang.form');

// FORM STEP 2 - form isi perpanjang kontrak
Route::get('/perpanjang/formperpanjang/{id}', [PerpanjangController::class, 'showForm'])
    ->name('perpanjang.formperpanjang');

// SIMPAN HASIL PERPANJANG
Route::post('/perpanjang/{id}', [PerpanjangController::class, 'store'])
    ->name('perpanjang.store');




Route::get('/laporan/index', [DashboardController::class, 'laporan'])->name('laporan.index');
Route::get('/laporan/download', [DashboardController::class, 'downloadPdf'])->name('laporan.download');


Route::get("pendaftaran/form_data_diri", [PendaftaranController::class, "create"])->name('pendaftaran.form');
Route::post("pendaftaran/create", [PendaftaranController::class, "store"])->name('pendaftaran.store');
Route::post('/pendaftaran/approve/{id_perjanjian}', [PendaftaranController::class, 'approve'])->name('pendaftaran.approve');


Route::get("/pendaftaran/list_data", [PerjanjianSewaController::class, "perjanjian_sewa"])->name('pendaftaran.list');
Route::get('/pendaftaran/form_edit/{id_perjanjian}', [PerjanjianSewaController::class, 'edit'])->name('pendaftaran.edit');
Route::post('/pendaftaran/update/{id_perjanjian}', [PerjanjianSewaController::class, 'update'])->name('pendaftaran.update');
Route::get('/pendaftaran/detail/{id_perjanjian}', [PerjanjianSewaController::class, 'detail_perjanjian']);
Route::get('/pendaftaran/perjanjian_dokumen/{id_perjanjian}', [PerjanjianSewaController::class, 'showPerjanjianDokumen'])->name('pendaftaran.perjanjian_dokumen');
Route::get('/perjanjian/preview/{id_perjanjian}', [PerjanjianSewaController::class, 'previewPerjanjianPDF'])->name('perjanjian.preview');

Route::get('/foto/{id_mitra}', [PerjanjianSewaController::class, 'showFoto'])->name('pendaftaran.foto');
Route::delete('/foto/{id_mitra}', [PerjanjianSewaController::class, 'deleteFoto'])->name('pendaftaran.foto.delete');


Route::get("pendaftaran/list_perjanjian", [HomeController::class, "list_perjanjian"])->name('menu.list_perjanjian');
Route::get("pendaftaran/perjanjian_event", [HomeController::class, "perjanjian"])->name('menu.perjanjian_event');


