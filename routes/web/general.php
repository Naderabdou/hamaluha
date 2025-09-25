<?php

use App\Http\Controllers\Site\General\CartController;
use App\Http\Controllers\Site\General\HomeController;
use App\Http\Controllers\Site\General\AboutController;
use App\Http\Controllers\Site\General\OfferController;
use App\Http\Controllers\Site\General\StoreController;
use App\Http\Controllers\Site\General\ContactController;
use App\Http\Controllers\Site\General\ProductController;
use App\Http\Controllers\Site\General\CategoryController;
use App\Http\Controllers\Site\General\FavoriteController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{id}', [StoreController::class, 'show'])->name('stores.show');

Route::get('/offers', [OfferController::class, 'index'])->name('offers');
Route::post('contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');
Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::post('join-us', [StoreController::class, 'joinUs'])->name('join-us')->middleware('auth');
Route::get('/favourites', [FavoriteController::class, 'index'])
    ->name('favourites.index')
    ->middleware('auth');

Route::post('/favourites/toggle/{id}', [FavoriteController::class, 'toggle'])
    ->name('favourites.toggle')
    ->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
