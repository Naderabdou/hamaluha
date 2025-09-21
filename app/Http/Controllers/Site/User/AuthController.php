<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('site.auth.login');
    }

    public function registerForm()
    {
        return view('site.auth.register');
    }

    public function newPasswordForm()
    {
        return view('site.auth.new-password');
    }

    public function sendEmailForm()
    {
        return view('site.auth.send-email');
    }

    public function verifyCodeForm()
    {
        return view('site.auth.verify-code');
    }
}
