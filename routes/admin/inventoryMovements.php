<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryMovementController;

Route::middleware('auth')->group(function () {
    Route::crud("inventory-movements", InventoryMovementController::class);
});
