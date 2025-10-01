<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'       => 'required|string|max:255',
            'name_en'       => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'desc_ar'       => 'required|string',
            'desc_en'       => 'required|string',
            // 'file'          => 'required|mimes:jpg,jpeg,png,webp,pdf|max:2048',
            // 'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

    }
}
