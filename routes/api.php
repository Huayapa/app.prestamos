<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // CRUD USUARIO
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::get('/user/{id}', [UserController::class, 'getUser']);
    Route::post('/user', [UserController::class, 'create']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    // CRUD BOOK
    Route::get('/books', [BookController::class, 'getBooks']);
    Route::get('/book/{id}', [BookController::class, 'getBook']);
    Route::post('/book', [BookController::class, 'create']);
    Route::put('/book/{id}', [BookController::class, 'update']);
    Route::delete('/book/{id}', [BookController::class, 'destroy']);
    // CRU LOAN
    Route::get('/loans', [LoanController::class, 'getLoans']);
    Route::get('/loan/{id}', [LoanController::class, 'getLoan']);
    Route::post('/loan', [LoanController::class, 'create']);
    Route::put('/loan/{id}', [LoanController::class, 'update']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

