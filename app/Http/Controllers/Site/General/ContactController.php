<?php
namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;


class ContactController extends Controller
{

    public function submitContactForm(ContactRequest $request)
    {
        Conact::create($request->validated());

        return redirect()->back()->with('success', __('تم إرسال رسالتك بنجاح.'));
    }
}
