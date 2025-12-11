<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
    Route::post('/store/create', [StoreController::class, 'store'])->name('store.store');
    Route::get('/store/edit', [StoreController::class, 'edit'])->name('store.edit');
    Route::patch('/store/edit', [StoreController::class, 'update'])->name('store.update');
    Route::delete('/store/{store}', [StoreController::class, 'destroy'])->name('store.destroy');

    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/product/edit/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/category/create', [ProductCategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [ProductCategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{category}/edit', [ProductCategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{category}', [ProductCategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [ProductCategoryController::class, 'destroy'])->name('category.destroy');
});

require __DIR__.'/auth.php';
