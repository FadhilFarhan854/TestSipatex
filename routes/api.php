<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SignaController;

Route::get('/reseps', [ResepController::class, 'index']);
Route::post('/resep', [ResepController::class, 'store']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/obatalkes', [ObatController::class, 'index']);
Route::get('/signa', [SignaController::class, 'index']);
Route::get('/resep/{id}', [ResepController::class, 'show']);
Route::get('/resep/{id}/cetak', [ResepController::class, 'cetak']);