<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\User\AuthController;
use App\Http\Controllers\Site\User\CartController;
use App\Http\Controllers\Site\User\HomeController;
use App\Http\Controllers\Site\User\AboutController;
use App\Http\Controllers\Site\User\OfferController;
use App\Http\Controllers\Site\User\StoreController;
use App\Http\Controllers\Site\User\ProductController;
use App\Http\Controllers\Site\User\ProfileController;
use App\Http\Controllers\Site\User\CategoryController;
use App\Http\Controllers\Site\User\FavouriteController;

Route::get('/privacy', function () {

    session()->put('lang', 'en');

    return view('site.privacy');
});

Route::get('/privacy/ar', function () {

    session()->put('lang', 'ar');

    return view('site.privacy');
});
Route::get('/privacy/en', function () {

    session()->put('lang', 'en');

    return view('site.privacy');
});

Route::namespace('Site')->name('site.')->middleware('lang')->group(function () {

    Route::namespace('User')->name('user.')->group(function () {

        Route::get('/login', [AuthController::class,'loginForm'])->name('login');
        Route::get('/register', [AuthController::class,'registerForm'])->name('register');

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about', [AboutController::class, 'index'])->name('about');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

        Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

        Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
        Route::get('/stores/{id}', [StoreController::class, 'show'])->name('stores.show');

        Route::get('/offers', [OfferController::class, 'index'])->name('offers');

        Route::get('cart', [CartController::class, 'index'])->name('cart');

        Route::get('/favourite', [FavouriteController::class, 'index'])->name('favourite');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    });
});


