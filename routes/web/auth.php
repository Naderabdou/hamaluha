<?php

use App\Http\Controllers\Site\Auth\AuthController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login-form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register-form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/forget-password', [AuthController::class, 'forgetPasswordForm'])->name('forget-password-form');
    Route::post('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget-password');

    Route::get('/verify-code', [AuthController::class, 'verifyCodeForm'])->name('verify-code-form');
    Route::post('/verify-code', [AuthController::class, 'checkCode'])->name('verify-code');

    Route::get('/resend-code', [AuthController::class, 'resendCode'])->name('resend-code');

    Route::get('/new-password', [AuthController::class, 'newPasswordForm'])->name('new-password-form');
    Route::post('/new-password', [AuthController::class, 'resetPassword'])->name('reset-password');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware();
