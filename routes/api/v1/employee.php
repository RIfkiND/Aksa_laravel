<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Employee\EmployeesController;

route::prefix('employees')->name('employees.')->group(function () {
    Route::get('/', [EmployeesController::class, 'index'])
        ->name('index');
    Route::post('/', [EmployeesController::class, 'store'])
        ->name('store');
    Route::put('/{employee}', [EmployeesController::class, 'update'])
        ->name('update');
    Route::delete('/{employee}', [EmployeesController::class, 'destroy'])
        ->name('destroy');
});
