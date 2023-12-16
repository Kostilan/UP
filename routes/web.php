<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CommentController;

// general
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/bookProduct/{id}', [BookController::class, 'bookProduct'])->name("bookProduct");
Route::get('/', [BookController::class, 'index'])->name("/");

// user
Route::post('/signUp', [UserController::class, 'signUp'])->name("signUp");
Route::post('/logIn', [UserController::class, 'logIn'])->name("logIn");
Route::get('/signout', [UserController::class, 'signout'])->name("signout");

Route::get('/account', [UserController::class, 'account'])->name("account");

Route::get('/account/accountUser', [UserController::class, 'accountUser'])->name("accountUser");
Route::post('/account/accountUserUpdate', [UserController::class, 'accountUserUpdate'])->name("accountUserUpdate"); 
Route::get('/account/accountBookMarks', [UserController::class, 'accountBookMarks'])->name("accountBookMarks");


// Admin
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/', [BookController::class, 'index'])->name("/");