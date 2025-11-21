<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataMitraController;
use App\Http\Controllers\PerjanjianSewaController;
use App\Http\Controllers\PendaftaranController;
use App\Models\DataMitra;
use App\Models\PerjanjianSewa;

Route::get("/", [HomeController::class, "beranda"])->name('home');
Route::get("home/beranda", [HomeController::class, "beranda"])->name('home');
Route::get("pendaftaran/form_data_diri", [HomeController::class, "form_pendaftaran"])->name('home');
Route::get("pendaftaran/list_data", [HomeController::class, "list_data"])->name('home');
Route::get("pendaftaran/perjanjian_event", [HomeController::class, "perjanjian"])->name('home');
Route::get("list_data_perjanjian/data_perjanjian", [HomeController::class, "data_perjanjian"])->name('home');


Route::get("pendaftaran/list_data", [PerjanjianSewaController::class, "perjanjian_sewa"]);
Route::get('/pendaftaran/form_edit/{id_perjanjian}', [PerjanjianSewaController::class, 'edit'])->name('pendaftaran.edit');
Route::post('/pendaftaran/update/{id_perjanjian}', [PerjanjianSewaController::class, 'update'])->name('pendaftaran.update');
Route::get('/pendaftaran/detail/{id_perjanjian}', [PerjanjianSewaController::class, 'detail_perjanjian']);
Route::get('/pendaftaran/perjanjian_dokumen/{id_perjanjian}', [PerjanjianSewaController::class, 'showPerjanjianDokumen'])->name('pendaftaran.perjanjian_dokumen');
Route::get('/perjanjian/preview/{id_perjanjian}', [PerjanjianSewaController::class, 'previewPerjanjianPDF'])->name('perjanjian.preview');
Route::get('/foto/{id_mitra}', [PerjanjianSewaController::class, 'showFoto'])->name('pendaftaran.foto');
Route::delete('/foto/{id_mitra}', [PerjanjianSewaController::class, 'deleteFoto'])->name('pendaftaran.foto.delete');

Route::get("pendaftaran/form_data_diri", [PendaftaranController::class, "create"]);
Route::post("pendaftaran/create", [PendaftaranController::class, "store"]); 