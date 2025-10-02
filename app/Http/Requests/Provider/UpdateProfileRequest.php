<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Store;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $userId = $this->user()->id;
        $storeId = Store::where('provider_id', $userId)->value('id');

        return [
            // بيانات المستخدم (اختياري)
            'name'  => 'nullable|string|max:255',
            'email' => ['nullable', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],

            // بيانات المتجر
            'store_name'  => 'required|string|max:255',
            'slug'        => ['nullable', 'string', 'max:255', Rule::unique('stores', 'slug')->ignore($storeId)],
            'store_email' => ['nullable', 'email', 'max:255', Rule::unique('stores', 'email')->ignore($storeId)],
            'phone' => ['nullable', 'digits:11'],
            'desc'        => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'store_name' => 'اسم المتجر',
            'store_email' => 'بريد المتجر',
        ];
    }
}
