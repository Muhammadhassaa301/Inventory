<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'price' => 'required_if:type,fixed',
            'variation.*.title' => 'required_if:type,variable',
            'variation.*.price' => 'required_with:variation.*.title'
        ];
    }

    public function messages()
    {
        return [
            'variation.*.title.required_if' => 'The variation field is required',
            'variation.*.price.required_with' => 'The price field is required'
        ];
    }
}
