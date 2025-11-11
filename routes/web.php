<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::put('/loans', [LoanController::class, 'update'])->name('loans.update');
    Route::put('/loans/{loan}/return', [LoanController::class, 'registerReturn'])->name('loans.return');
    // Route::delete('/loans', [BookController::class, 'destroy'])->name('loans.destroy');
});

require __DIR__.'/auth.php';
