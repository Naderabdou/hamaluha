<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginForm(): View
    {
        return view('site.auth.login');
    }

    public function registerForm(): View
    {
        return view('site.auth.register');
    }

    public function newPasswordForm(): View
    {
        return view('site.auth.new-password');
    }

    public function sendEmailForm(): View
    {
        return view('site.auth.send-email');
    }

    public function verifyCodeForm(): View
    {
        return view('site.auth.verify-code');
    }
}
