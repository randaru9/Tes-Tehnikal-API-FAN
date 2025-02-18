<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Epresence\ApproveEpresenceController;
use App\Http\Controllers\Epresence\CreateEpresenceController;
use App\Http\Controllers\Epresence\GetEpresenceByUserIdController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'action'] );
});

Route::prefix('epresence')->middleware('jwt')->group(function () {
    Route::post('create', [CreateEpresenceController::class, 'action'] );
    Route::put('approve', [ApproveEpresenceController::class, 'action'] );
    Route::get('get', [GetEpresenceByUserIdController::class, 'action'] );
});
