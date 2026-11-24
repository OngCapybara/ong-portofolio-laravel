<?php

use App\Http\Controllers\Api\AdminProjectController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Latihan 5a, 5b, & Login Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('portfolio')->group(function () {
    Route::get('/profile',         [PortfolioController::class, 'profile']);
    Route::get('/skills',          [PortfolioController::class, 'skills']);
    Route::get('/projects',        [PortfolioController::class, 'projects']);
    Route::get('/projects/{slug}', [PortfolioController::class, 'projectDetail']);
    Route::get('/experiences',     [PortfolioController::class, 'experiences']);
    Route::get('/certificates',    [PortfolioController::class, 'certificates']);

    Route::post('/messages', [PortfolioController::class, 'storeMessage'])
        ->middleware('throttle:5,1');
});

// Autentikasi Admin
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| 2. RUTE TERPROTEKSI SANCTUM (Wajib Header: Authorization: Bearer <token>)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',      [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/admin/projects',         [AdminProjectController::class, 'index']);
    Route::post('/admin/projects',        [AdminProjectController::class, 'store']);
    Route::get('/admin/projects/{id}',    [AdminProjectController::class, 'show']);
    Route::put('/admin/projects/{id}',    [AdminProjectController::class, 'update']);
    Route::delete('/admin/projects/{id}', [AdminProjectController::class, 'destroy']);
});
