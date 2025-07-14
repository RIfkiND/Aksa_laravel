<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Nilai\NilaiRtController;
use App\Http\Controllers\Api\V1\Nilai\NilaiStController;


Route::get('/nilaiRT', [NilaiRtController::class, 'index'])
    ->name('rt.index');

Route::get('/nilaiST', [NilaiStController::class, 'index'])
    ->name('st.index');
