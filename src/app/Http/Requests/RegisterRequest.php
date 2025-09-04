<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0|max:1000000',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'donation' => 'required|in:none,yes,no,cow',
            'description' => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required.',
            'price.required' => 'Price is required.',
            'price.integer' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0 yen.',
            'price.max' => 'Price must not exceed 1,000,000 yen.',
            'image.required' => 'Product image is required.',
            'image.image' => 'Uploaded file must be an image.',
            'image.mimes' => 'Image must be a .png, .jpg, or .jpeg file.',
            'donation.required' => 'Donation selection is required.',
            'donation.in' => 'Invalid donation option selected.',
            'description.required' => 'Product description is required.',
            'description.max' => 'Description must be within 120 characters.',
        ];
    }

}
