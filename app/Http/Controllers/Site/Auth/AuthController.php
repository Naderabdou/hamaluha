<?php

namespace App\Http\Controllers\Site\Auth;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repositories\Auth\AuthRepository;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ForgetPasswordRequest;


class AuthController extends Controller
{
    public function __construct(protected AuthRepository $authRepository) {}
    public function loginForm(): View
    {
        return view('site.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authRepository->login($request->validated());
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }
        auth()->login($user);
        return redirect()->route('site.home');
    }

    public function registerForm(): View
    {
        return view('site.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authRepository->register($request->validated());
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'The provided data is incorrect.']);
        }
        auth()->login($user);
        return redirect()->route('site.home');
    }

    public function forgetPasswordForm(): View
    {
        return view('site.auth.send-email');
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $this->authRepository->forgetPassword($request->validated());

        session(['reset_email' => $request->email]);

        return redirect()->route('site.verify-code-form');

    }

    public function verifyCodeForm(): View
    {
        return view('site.auth.verify-code');
    }

    public function resendCode()
    {
        $this->authRepository->resendCode(session('reset_email'));
        return redirect()->route('site.verify-code-form');

    }

    public function checkCode(CheckCodeRequest $request)
    {
        $user = $this->authRepository->checkCode($request->validated());

        if (!$user) {
            return redirect()->back()->withErrors(['code' => 'The provided code is incorrect or has expired.']);
        } else {
            session(['reset_token' => $user->token]);
            return redirect()->route('site.new-password-form');
        }

    }

    public function newPasswordForm(): View
    {
        return view('site.auth.new-password');
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = $this->authRepository->resetPassword($request->validated());


        if (!$user) {
            return redirect()->back()->withErrors(['password' => 'Failed to reset password']);
        }
            return redirect()->route('site.login-form')->with('status', 'Password reset successfully');
    }

    public function logout()
    {

        $this->authRepository->logout();

        return redirect()->route('site.home');

    }

}
