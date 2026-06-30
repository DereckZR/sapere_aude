<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::crud("roles", RoleController::class);
Route::prefix('roles')->group(function () {
    Route::get('/select', [RoleController::class, 'getAllForSelect'])->name('roles.getAllForSelect');
});