<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

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
