<?php

use App\Http\Controllers\CycleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cycles')->group(function () {
    Route::get('/', [CycleController::class, 'index'])->name('cycles.index');
    Route::get('/getAll', [CycleController::class, 'getAll'])->name('cycles.getAll');
    Route::get('/getAllTrashed', [CycleController::class, 'getAllTrashed'])->name('cycles.getAllTrashed');
    Route::get('/{id}/findById', [CycleController::class, 'findById'])->name('cycles.findById');
    Route::post('/', [CycleController::class, 'store'])->name('cycles.store');
    Route::put('/{id}', [CycleController::class, 'update'])->name('cycles.update');
    Route::delete('/{id}', [CycleController::class, 'delete'])->name('cycles.delete');
    Route::patch('/{id}', [CycleController::class, 'restore'])->name('cycles.restore');
});

// Route::prefix('members')->group(function () {
//     Route::get('/', [MemberController::class, 'index'])->name('members.index');
//     Route::get('/create', [MemberController::class, 'create'])->name('members.create');
//     Route::post('/', [MemberController::class, 'store'])->name('members.store');
//     Route::get('/{id}', [MemberController::class, 'show'])->name('members.show');
//     Route::get('/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
//     Route::put('/{id}', [MemberController::class, 'update'])->name('members.update');
//     Route::delete('/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
// });

// Route::prefix('transactions')->group(function () {
//     Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
//     Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
//     Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
//     Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show');
//     Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
//     Route::put('/{id}', [TransactionController::class, 'update'])->name('transactions.update');
//     Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
// });
