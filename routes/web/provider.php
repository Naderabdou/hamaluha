<?php

use App\Http\Controllers\Site\Provider\HomeController;


Route::get('/', [HomeController::class, 'index'])->name('home');
