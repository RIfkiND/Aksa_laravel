<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;

// Tempat untuk route API Auth version 1


Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
