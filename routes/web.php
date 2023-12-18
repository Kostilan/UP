<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CommentController;

// general
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/newBooks', [BookController::class, 'newBooks'])->name("newBooks");
Route::get('/popularBooks', [BookController::class, 'popularBooks'])->name("popularBooks");
Route::get('/bookProduct/{id}', [BookController::class, 'bookProduct'])->name("bookProduct");
Route::get('/bookProduct/bookMarks/{id}', [BookController::class, 'bookMarksCreate'])->name("bookMarksCreate"); 
Route::get('/bookProduct/bookMarks/{id}/delete', [BookController::class, 'bookMarksDelete'])->name("bookMarksDelete");

// user
Route::post('/signUp', [UserController::class, 'signUp'])->name("signUp");
Route::post('/logIn', [UserController::class, 'logIn'])->name("logIn");
Route::get('/signout', [UserController::class, 'signout'])->name("signout");
Route::middleware('checkRole:2')->group(function () {

Route::post('/bookProduct/commentCreate', [CommentController::class, 'commentCreate'])->name("commentCreate");
Route::post('/bookProduct/commentUpdate/{id}', [CommentController::class, 'commentUpdate'])->name("commentUpdate");


Route::get('/account', [UserController::class, 'account'])->name("account");
Route::get('/account/accountUser', [UserController::class, 'accountUser'])->name("accountUser");
Route::post('/account/accountUserUpdate', [UserController::class, 'accountUserUpdate'])->name("accountUserUpdate");
Route::get('/account/accountBookMarks', [UserController::class, 'accountBookMarks'])->name("accountBookMarks");
}); 

// Admin
// Route::middleware('checkRole:2')->group(function () {
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/', [BookController::class, 'index'])->name("/");
Route::get('/', [BookController::class, 'index'])->name("/");
// }); 