<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'homepage'])->name('admin.homepage');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/books/upload', [AdminController::class, 'uploadBooks'])->name('admin.books.upload');
    Route::get('/admin/category/upload', [AdminController::class, 'uploadCategory'])->name('admin.category.upload');
    Route::post('/admin/books/post', [AdminController::class, 'postBooks'])->name('admin.books.post');
    Route::post('/admin/category/post', [AdminController::class, 'postCategory'])->name('admin.category.post');
    Route::get('/admin/books/edit/{book}', [AdminController::class, 'editBooks'])->name('admin.books.edit');
    Route::post('/admin/books/update/{book}', [AdminController::class, 'updateBooks'])->name('admin.books.update');
    Route::get('/admin/books/list', [BookController::class, 'listBooks'])->name('admin.books.list');
    Route::delete('/admin/books/delete/{book}', [BookController::class, 'deleteBooks'])->name('admin.books.delete');
    Route::delete('/admin/category/delete/{category}', [BookController::class, 'deleteCategory'])->name('admin.category.delete');
});
