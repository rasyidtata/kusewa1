<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;


Route::get('/api/aset/search', [PendaftaranController::class, 'search'])->name('api.aset.search');
Route::get('/mitra/search', [App\Http\Controllers\PendaftaranController::class, 'searchmitra'])->name('api.mitra.search');






// Route untuk pencarian mitra
Route::get('/api/search-mitra', [App\Http\Controllers\PendaftaranController::class, 'searchMitra']);

// Route untuk pencarian aset
Route::get('/api/search-aset', [App\Http\Controllers\PendaftaranController::class, 'searchAset']);

// Route untuk mendapatkan detail mitra
Route::get('/api/get-mitra/{id}', [App\Http\Controllers\PendaftaranController::class, 'getMitraDetail']);

// Route untuk mendapatkan detail aset
Route::get('/api/get-aset/{id}', [App\Http\Controllers\PendaftaranController::class, 'getAsetDetail']);