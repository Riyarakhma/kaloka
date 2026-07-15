<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KearifanLokalController;
use App\Http\Controllers\Api\PengaturanController;
use App\Http\Controllers\Api\WisataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

// Publik
Route::get('/kearifan-lokal', [KearifanLokalController::class, 'index']);
Route::get('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'show']);
Route::get('/pengaturan', [PengaturanController::class, 'index']);
Route::get('/wisata', [WisataController::class, 'index']);
Route::get('/wisata/{wisatum}', [WisataController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/kearifan-lokal', [KearifanLokalController::class, 'store']);
    Route::put('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'update']);

    Route::post('/wisata', [WisataController::class, 'store']);
    Route::put('/wisata/{wisatum}', [WisataController::class, 'update']);

    Route::middleware('peran.api:admin')->group(function () {
        Route::delete('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'destroy']);
        Route::put('/pengaturan', [PengaturanController::class, 'update']);
        Route::delete('/wisata/{wisatum}', [WisataController::class, 'destroy']);
    });
});