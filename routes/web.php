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
Route::get("pendaftaran/list_perjanjian", [HomeController::class, "list_perjanjian"])->name('home');
Route::get("pendaftaran/perjanjian", [HomeController::class, "perjanjian"])->name('home');

Route::get("pendaftaran/list_data", [PerjanjianSewaController::class, "perjanjian_sewa"]);
Route::get('/pendaftaran/list_perjanjian/{id_perjanjian}', [PerjanjianSewaController::class, 'edit'])->name('pendaftaran.edit');
Route::post('/pendaftaran/update/{id_perjanjian}', [PerjanjianSewaController::class, 'update'])->name('pendaftaran.update');

Route::get("pendaftaran/form_data_diri", [PendaftaranController::class, "create"]);
Route::post("pendaftaran/create", [PendaftaranController::class, "store"]); 