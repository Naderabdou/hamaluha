<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'desc_ar'    => 'sometimes|string|max:255',
            'desc_en'    => 'sometimes|string|max:255',
            'discount'   => 'sometimes|numeric|min:1|max:100',
            'image'      => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
            'type'       => 'sometimes|string|in:percentage,fixed',
            'start_at'   => 'sometimes|date',
            'end_at'     => 'sometimes|date|after:start_at',
            'products'   => 'sometimes|array|min:1',
            'products.*' => 'exists:products,id',
        ];
    }
}
