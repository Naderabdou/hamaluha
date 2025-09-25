<?php

use App\Http\Controllers\Site\General\HomeController;
use App\Http\Controllers\Site\General\AboutController;
use App\Http\Controllers\Site\General\OfferController;
use App\Http\Controllers\Site\General\StoreController;
use App\Http\Controllers\Site\General\ContactController;
use App\Http\Controllers\Site\General\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/category/{slug}/products', [ProductController::class, 'byCategory'])->name('category.products');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{id}', [StoreController::class, 'show'])->name('stores.show');

Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::post('contact', [ContactController::class, 'submitContactForm'])->name('contact.submit');
Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::post('join-us', [StoreController::class, 'joinUs'])->name('join-us')->middleware('auth');

Route::post('/products/{product}/review', [ProductController::class, 'addReview'])
    ->name('products.review');


Route::get('/offers/{id}', [OfferController::class, 'show'])->name('offers.show');
