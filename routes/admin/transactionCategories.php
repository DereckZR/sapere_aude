<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionCategoryController;

Route::middleware('auth')->group(function () {
    Route::crud("transaction-categories", transactionCategoryController::class);
});
