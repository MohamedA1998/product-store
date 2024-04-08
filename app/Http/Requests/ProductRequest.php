<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'          => 'required|max:255',
            'price'         => 'required|integer|min:1',
            'quantity'      => 'required|integer|min:1',
            'description'   => 'required',
            'image'         => 'image',
            'images'        => 'array'
        ];
    }



    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'name.max'      => 'A name Should Be Smaller Than 255 Char',
            'price.required' => 'A price is required',
            'quantity.required' => 'A quantity is required',
            'description.required' => 'A description is required',
        ];
    }
}
