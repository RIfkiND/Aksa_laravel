<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Division\DivisionsController;

Route::prefix('divisions')->name('divisions.')->group(function () {
    Route::get('/', [DivisionsController::class, 'index'])
        ->name('index');
});
