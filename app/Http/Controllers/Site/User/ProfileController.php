<?php

namespace App\Http\Controllers\Site\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\ChangeInfoRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = auth()->user()->purchasedProducts()->distinct()->get();
        return view('site.user.profile', compact('products'));
    }

    public function changeInfo(ChangeInfoRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        return back()->with('success', __('تم تعديل بياناتك بنجاح'));
    }

    public function changePassword(ResetPasswordRequest $request)
    {
        dd($request->all());
        $data = $request->validated();
        $user = auth()->user();
        $user->update([
            'password' => $data['password'],
        ]);
        return back()->with('success', __('تم تعديل بياناتك بنجاح'));
    }

    public function deleteAccount()
    {
        $user = auth()->user();
        $user->delete();
        return to_route('site.home')
            ->with('success', __('تم حذف حسابك'));
    }
}
