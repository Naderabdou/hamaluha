<?php

use App\Models\Product;
use App\Http\Controllers\Site\Provider\HomeController;
use App\Http\Controllers\Site\Provider\ProductController;
use App\Http\Controllers\Site\Provider\CategoryController;
use App\Http\Controllers\Site\Provider\ProductQuestionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('/products', ProductController::class);
Route::post('/questions', [ProductQuestionController::class, 'store'])->name('questions.store');
Route::delete('/questions/{id}', [ProductQuestionController::class, 'destroy'])->name('questions.destroy');


