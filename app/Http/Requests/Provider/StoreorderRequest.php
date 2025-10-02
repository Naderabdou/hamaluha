<?php

namespace App\Http\Requests\Provider;

use Illuminate\Foundation\Http\FormRequest;

class StoreorderRequest extends FormRequest
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
            'user_id'       => 'required|exists:users,id',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'required|string|max:20',
            'total'         => 'required|numeric|min:0',
            'type'          => 'required|string|in:online,offline', // تقدر تزود أنواعك
            'status'        => 'required|string|in:pending,processing,completed,cancelled',
            'payment_status'=> 'required|string|in:pending,paid,failed',

            'items'                     => 'required|array|min:1',
            'items.*.product_id'        => 'required|exists:products,id',
            'items.*.store_id'          => 'required|exists:stores,id',
            'items.*.name'              => 'required|string|max:255',
            'items.*.image'             => 'nullable|string|max:255',
            'items.*.price'             => 'required|numeric|min:0',
        ];
    }
}
