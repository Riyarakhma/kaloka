<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KearifanLokalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

// Publik: bisa diakses tanpa login
Route::get('/kearifan-lokal', [KearifanLokalController::class, 'index']);
Route::get('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Perlu login (admin & pengelola boleh)
    Route::post('/kearifan-lokal', [KearifanLokalController::class, 'store']);
    Route::put('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'update']);

    // Perlu login DAN harus admin
    Route::middleware('peran.api:admin')->group(function () {
        Route::delete('/kearifan-lokal/{kearifanLokal}', [KearifanLokalController::class, 'destroy']);
    });
});