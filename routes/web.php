<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SignaController;
use App\Http\Controllers\RacikanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/resep/input', [ResepController::class, 'create']);
Route::post('/resep', [ResepController::class, 'store']);
Route::get('/obat', [ObatController::class, 'obat'])->name('obat.showpaginate');
Route::get('/signa', [SignaController::class, 'signa'])->name('signa.showpaginate');
Route::get('/racikan', [RacikanController::class, 'index'])->name('racikan.index');
Route::get('/racikan/{id}', [RacikanController::class, 'show'])->name('racikan.show');
Route::get('/racikan/{id}/cetak', [RacikanController::class, 'cetak'])->name('racikan.cetak');

