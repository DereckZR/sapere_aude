<?php

use App\Http\Controllers\CycleController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin/users.php';
require __DIR__ . '/admin/members.php';
require __DIR__ . '/admin/roles.php';

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::crud('cycles', CycleController::class);
Route::prefix('cycles')->group(function () {
    Route::get('/select', [CycleController::class, 'getAllForSelect'])->name('cycles.getAllForSelect');
});

Route::crud('members', MemberController::class);
