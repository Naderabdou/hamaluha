<?php

use App\Http\Controllers\Site\Provider\HomeController;
use App\Http\Controllers\Site\Provider\ProductController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('/products', ProductController::class);
