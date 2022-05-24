<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FileUploadingController;
use Illuminate\Support\Facades\Route;

Route::post('/tinymce/image', [FileUploadingController::class, 'uploadTinyMceImage'])->name('store-tinymce-image');
Route::get('/', [AdminController::class, 'index'])->name('admin');

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::patch('/sorting', [CategoryController::class, 'sortingUpdate'])->name('category.sorting.update');
});

Route::prefix('article')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('article');
    Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
    Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('/store', [ArticleController::class, 'store'])->name('article.store');
    Route::put('/{article}/update', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/{article}/delete', [ArticleController::class, 'delete'])->name('article.delete');
});

Route::prefix('tag')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('tag');
    Route::get('/create', [TagController::class, 'create'])->name('tag.create');
    Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('tag.edit');
    Route::post('/store', [TagController::class, 'store'])->name('tag.store');
    Route::put('/{tag}/update', [TagController::class, 'update'])->name('tag.update');
    Route::delete('/{tag}/delete', [TagController::class, 'delete'])->name('tag.delete');
});
