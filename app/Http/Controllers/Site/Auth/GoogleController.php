<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // لو المستخدم موجود يدخل عادي
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // لو مش موجود اعمله تسجيل جديد
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt('123456dummy'), // باسورد شكلي
            ]);
        }

        Auth::login($user);

        return redirect()->route('site.home'); // رجعه للصفحة الرئيسية
    }
}
