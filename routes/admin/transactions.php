<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionController;

Route::middleware('auth')->group(function () {
    Route::crud("transactions", transactionController::class);
});
