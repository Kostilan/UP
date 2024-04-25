<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;

// general
Route::get('/', [BookController::class, 'index'])->name("index");
Route::get('/newBooks', [BookController::class, 'newBooks'])->name("newBooks");
Route::get('/popularBooks', [BookController::class, 'popularBooks'])->name("popularBooks");
Route::get('/genreBooks/{id}', [BookController::class, 'genreBooks'])->name("genreBooks");
Route::get('/authorsBooks/{id}', [BookController::class, 'authorsBooks'])->name("authorsBooks");
Route::get('/bookProduct/{id}', [BookController::class, 'bookProduct'])->name("bookProduct");
Route::get('/bookProduct/readDocument/{filename}', [BookController::class,'readDocument'] )->name('readDocument')->middleware('auth');
Route::get('/bookProduct/bookMarks/{id}', [BookController::class, 'bookMarksCreate'])->name("bookMarksCreate")->middleware('auth'); 
Route::get('/bookProduct/bookMarks/{id}/delete', [BookController::class, 'bookMarksDelete'])->name("bookMarksDelete")->middleware('auth');

// user
Route::post('/signUp', [UserController::class, 'signUp'])->name("signUp");
Route::post('/logIn', [UserController::class, 'logIn'])->name("logIn");
Route::get('/signout', [UserController::class, 'signout'])->name("signout");

    Route::post('/bookProduct/commentCreate', [CommentController::class, 'commentCreate'])->name("commentCreate")->middleware('auth');
    Route::post('/bookProduct/commentUpdate/{id}', [CommentController::class, 'commentUpdate'])->name("commentUpdate")->middleware('auth');
    Route::get('/bookProduct/reviewCreate/{id}', [CommentController::class, 'reviewCreate'])->name("reviewCreate")->middleware('auth');
    Route::post('/bookProduct/reviewCreate_valid', [CommentController::class, 'reviewCreate_valid'])->name("reviewCreate_valid")->middleware('auth');
    Route::put('/reviews/{id}/update', [CommentController::class, 'reviewUpdate_valid'])->name('reviewUpdate_valid')->middleware('auth');
    Route::get('/account', [UserController::class, 'account'])->name("account")->middleware('auth');
    Route::get('/account/accountUser', [UserController::class, 'accountUser'])->name("accountUser")->middleware('auth');
    Route::post('/account/accountUserUpdate', [UserController::class, 'accountUserUpdate'])->name("accountUserUpdate")->middleware('auth');
    Route::get('/account/accountBookMarks', [UserController::class, 'accountBookMarks'])->name("accountBookMarks")->middleware('auth');

    Route::get('/subscriptions', [SubscriptionController::class, 'subscriptions'])->name("subscriptions")->middleware('auth');
    Route::post('/subscriptions/subscriptionCreate', [SubscriptionController::class, 'subscriptionCreate'])->name("subscriptionCreate")->middleware('auth');

// Admin
Route::middleware('CheckRole:1')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->name("admin");
    Route::get('/admin/bookCreate', [AdminController::class, 'bookCreate'])->name("bookCreate");
    Route::post('/admin/bookCreaten', [AdminController::class, 'bookCreate_valid'])->name("bookCreate_valid");
    Route::get('/admin/bookUpdate/{id}', [AdminController::class, 'bookUpdate'])->name("bookUpdate");
    Route::post('/admin/bookUpdaten/{id}', [AdminController::class, 'bookUpdatemin_valid'])->name("bookUpdatemin_valid");
    Route::get('/admin/books/delete/{ $id}', [AdminController::class, 'bookDelete'])->name("bookDelete");

    // Издательства
    Route::get('/admin/publications', [AdminController::class, 'publications'])->name("publications");
    Route::get('/admin/publications/publicationsUpdate/{id}', [AdminController::class, 'publicationsUpdate'])->name("publicationsUpdate");
    Route::get('/admin/publications/publicationsCreate', [AdminController::class, 'publicationsCreate'])->name("publicationsCreate");
    Route::delete('/admin/publications/publicationDelete/{id}', [BookController::class, 'publicationDelete'])->name('publicationDelete');
    Route::post('/admin/publications/publicationCreate', [BookController::class, 'publicationCreate'])->name("publicationsCreate");
    Route::post('/admin/publications/publicationUpdate', [BookController::class, 'publicationUpdate'])->name("publicationUpdate");

    // Авторы
    Route::get('/admin/authors', [AdminController::class, 'authors'])->name("authors");
    Route::get('/admin/authors/authorsUpdate/{id}', [AdminController::class, 'authorsUpdate'])->name("authorsUpdate");
    Route::get('/admin/authors/authorsCreate', [AdminController::class, 'authorsCreate'])->name("authorsCreate");
    Route::delete('/admin/authors/authorDelete/{id}', [BookController::class, 'authorDelete'])->name('authorDelete');
    Route::post('/admin/authors/authorCreate', [BookController::class, 'authorCreate'])->name("authorCreate");
    Route::post('/admin/authors/authorUpdate', [BookController::class, 'authorUpdate'])->name("authorUpdate");

    // Жанры
    Route::get('/admin/genres', [AdminController::class, 'genres'])->name("genres");
    Route::get('/admin/genres/genresUpdate/{id}', [AdminController::class, 'genresUpdate'])->name("genresUpdate");
    Route::get('/admin/genres/genresCreate', [AdminController::class, 'genresCreate'])->name("genresCreate");
    Route::delete('/admin/genres/genreDelete/{id}', [BookController::class, 'genreDelete'])->name('genreDelete');
    Route::post('/admin/genres/genreCreate', [BookController::class, 'genreCreate'])->name("genreCreate");
    Route::post('/admin/genres/genreUpdate', [BookController::class, 'genreUpdate'])->name("genreUpdate");

     // Категории
     Route::get('/admin/categories', [AdminController::class, 'categories'])->name("categories");
     Route::get('/admin/categories/categoriesUpdate/{id}', [AdminController::class, 'categoriesUpdate'])->name("genresUpdate");
     Route::get('/admin/categories/categoriesCreate', [AdminController::class, 'categoriesCreate'])->name("genresCreate");
     Route::delete('/admin/categories/categoryDelete/{id}', [BookController::class, 'categoryDelete'])->name('categoryDelete');
     Route::post('/admin/categories/categoryCreate', [BookController::class, 'categoryCreate'])->name("categoryCreate");
     Route::post('/admin/categories/categoryUpdate', [BookController::class, 'categoryUpdate'])->name("categoryUpdate");
}); 