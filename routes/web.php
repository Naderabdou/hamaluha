<?php

use App\Enums\UserType;
use Illuminate\Support\Facades\Route;

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

Route::name('site.')->middleware('lang')->group(function () {

    require base_path('routes/web/auth.php');
    require base_path('routes/web/general.php');

    Route::prefix(UserType::USER->value)
        ->middleware(['check.type:'.UserType::USER->value])
        ->group(base_path('routes/web/user.php'));

    Route::prefix(UserType::PROVIDER->value)
        ->middleware(['check.type:'.UserType::PROVIDER->value])
        ->group(base_path('routes/web/provider.php'));

});
