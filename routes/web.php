<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataMitraController;
use App\Http\Controllers\PerjanjianSewaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PerpanjangController;
use App\Http\Controllers\DashboardController;



Route::get('/login', [AuthController::class, 'tampillogin'])->name('login');
Route::POST('submit/login', [AuthController::class, 'submitlogin'])->name('submit.login');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['checkRole:admin,pegawai'])->group(function () {

        // HOME & DASHBOARD
        Route::get("pendaftaran/form_data_diri", [HomeController::class, "form_pendaftaran"])->name('home');
        Route::get("pendaftaran/list_data", [HomeController::class, "list_data"])->name('home');
        Route::get("pendaftaran/perjanjian_event", [HomeController::class, "perjanjian"])->name('home');
        Route::get("list_data_perjanjian/data_perjanjian", [HomeController::class, "data_perjanjian"])->name('home');
        Route::get('/admin_fitur/pendaftaran', [HomeController::class, 'admin_pendaftaran']);
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/home/beranda', [DashboardController::class, 'index'])->name('dashboard.beranda');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // PERPANJANGAN KONTRAK
        Route::get('/perpanjang', [PerpanjangController::class, 'index'])->name('perpanjang.index');
        Route::get('/perpanjang/form/{id}', [PerpanjangController::class, 'form'])->name('perpanjang.form');
        Route::get('/perpanjang/formperpanjang/{id}', [PerpanjangController::class, 'showForm'])->name('perpanjang.formperpanjang');
        Route::post('/perpanjang/{id}', [PerpanjangController::class, 'store'])->name('perpanjang.store');


        // PENDAFTARAN MITRA
        Route::get('pendaftaran/form_data_diri', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
        Route::post('pendaftaran/create', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        Route::get('pendaftaran/list_data', [PerjanjianSewaController::class, 'perjanjian_sewa'])->name('pendaftaran.list');

        // LIST DATA MITRA
        Route::get("/list_data/data_perjanjian", [PerjanjianSewaController::class, "perjanjian_sewa"])->name('list_data.perjanjian');
        Route::get('/pendaftaran/form_edit/{id_perjanjian}', [PerjanjianSewaController::class, 'edit'])->name('pendaftaran.edit');
        Route::post('/pendaftaran/update/{id_perjanjian}', [PerjanjianSewaController::class, 'update'])->name('pendaftaran.update');
        Route::get('/pendaftaran/detail/{id_perjanjian}', [PerjanjianSewaController::class, 'detail_perjanjian']);
        Route::get('/pendaftaran/perjanjian_dokumen/{id_perjanjian}', [PerjanjianSewaController::class, 'showPerjanjianDokumen'])->name('pendaftaran.perjanjian_dokumen');
        Route::delete('/produk/delete/{id_perjanjian}', [PerjanjianSewaController::class, 'destroy'])->name('perjanjian.destroy');

        Route::get('/foto/{id_mitra}', [PerjanjianSewaController::class, 'showFoto'])->name('pendaftaran.foto');
        Route::delete('/foto/{id_mitra}', [PerjanjianSewaController::class, 'deleteFoto'])->name('pendaftaran.foto.delete');

        // PERSETUJUAN PERJANJIAN
        Route::post('/pendaftaran/approve/{id_perjanjian}', [PendaftaranController::class, 'approve'])->name('pendaftaran.approve');
        Route::get('/pendaftaran/fitur_filter', [PendaftaranController::class, 'fitur_filter'])->name('pendaftaran.fitur_filter');

        // LAPORAN
        Route::get('/laporan/index', [DashboardController::class, 'laporan'])->name('laporan.index');
        Route::get('/laporan/download', [DashboardController::class, 'downloadPdf'])->name('laporan.download');

        //LIST PERJANJIAN
        Route::get("pendaftaran/list_perjanjian", [HomeController::class, "list_perjanjian"])->name('menu.list_perjanjian');
        Route::get("pendaftaran/perjanjian_event", [HomeController::class, "perjanjian"])->name('menu.perjanjian_event');
        Route::get('/list_data/data_perjanjian/export-excel', [PerjanjianSewaController::class, 'exportExcel'])->name('perjanjian.export.excel');
        Route::get('/perjanjian-sewa/suggest-nama', [PerjanjianSewaController::class, 'suggestNama'])->name('perjanjian-sewa.suggest-nama');
        Route::get('/perjanjian-sewa/search', [PerjanjianSewaController::class, 'searchPerjanjianSewa'])->name('perjanjian-sewa.search');

        // API untuk autocomplete
        Route::get('/api/aset/search', [App\Http\Controllers\PendaftaranController::class, 'search'])->name('api.aset.search');
        // Route untuk pencarian mitra (API endpoint)
        Route::get('/api/mitra/search', [App\Http\Controllers\PendaftaranController::class, 'searchmitra'])->name('api.mitra.search');


        
     });
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::get('/admin_fitur/pendaftaran', [AdminController::class, 'create'])->name('admin.pendaftaran');
        Route::post('/admin_fitur/pendaftaran/create', [AdminController::class, 'store'])->name('admin.pendaftaran.store');
        Route::get('/admin_fitur/list', [AdminController::class, 'list'])->name('admin.list');
        Route::delete('/list-pegawai/delete/{id}', [AdminController::class, 'destroy'])->name('admin.pegawai.delete');
    });


});

