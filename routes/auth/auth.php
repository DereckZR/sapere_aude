<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'verifyLogin')->name('login.verify');
    Route::post('/logout', 'logout')->name('logout');
});
