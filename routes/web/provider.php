<?php

use App\Models\Product;
use App\Http\Controllers\Site\Provider\HomeController;
use App\Http\Controllers\Site\Provider\OfferController;
use App\Http\Controllers\Site\Provider\OrderController;
use App\Http\Controllers\Site\Provider\ProductController;

use App\Http\Controllers\Site\Provider\CategoryController;
use App\Http\Controllers\Site\Provider\ProductQuestionController;
use App\Http\Controllers\Site\Provider\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('/products', ProductController::class);
Route::post('/questions', [ProductQuestionController::class, 'store'])->name('questions.store');
Route::delete('/questions/{id}', [ProductQuestionController::class, 'destroy'])->name('questions.destroy');


Route::resource('provider/offers', OfferController::class);

Route::get('{offer}/activate', [OfferController::class, 'activate'])->name('activate');
Route::get('{offer}/pause', [OfferController::class, 'pause'])->name('pause');
Route::get('{offer}/discounted', [OfferController::class, 'discounted'])->name('discounted');
Route::get('/offers/all', [OfferController::class, 'all'])->name('all');

Route::resource('provider/orders', OrderController::class)->only(['index', 'show']);;
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
