<?php

use App\Http\Controllers\CycleController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::crud('cycles', CycleController::class);
Route::crud('members', MemberController::class);
