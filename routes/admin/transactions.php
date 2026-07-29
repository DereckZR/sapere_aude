<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionController;

Route::middleware('auth')->group(function () {
    Route::crud("transactions", transactionController::class);
    Route::prefix('transactions')->group(function () {
        Route::get('/getLatest', [transactionController::class, 'getLatest'])->name('transactions.getLatest');
    });
});
