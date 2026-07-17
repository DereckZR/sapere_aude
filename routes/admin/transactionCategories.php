<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionCategoryController;

Route::middleware('auth')->group(function () {
    Route::crud("transaction-categories", transactionCategoryController::class);
    Route::prefix('transaction-categories')->group(function () {
        Route::get('/select', [transactionCategoryController::class, 'getAllForSelect'])->name('transaction-categories.getAllForSelect');
    });
});
