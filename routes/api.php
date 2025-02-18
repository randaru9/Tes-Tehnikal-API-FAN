<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Epresence\CreateEpresenceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'action'] );
});

Route::prefix('epresence')->middleware('jwt')->group(function () {
    Route::post('create', [CreateEpresenceController::class, 'action'] );
});
