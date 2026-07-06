<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::middleware('auth')->group(function () {
    Route::crud("members", MemberController::class);
    Route::prefix('members')->group(function () {
        Route::get('/select', [MemberController::class, 'getAllForSelect'])->name('members.getAllForSelect');
    });
});
