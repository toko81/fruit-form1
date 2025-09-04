<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'price' => 'nullable|integer|min:0|max:100000',
            'grade' => 'nullable|in:elementary,middle,high',
            'description' => 'nullable|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'price.integer' => 'Price must be a number.',
            'price.min' => 'Price must be at least 0 yen.',
            'price.max' => 'Price must not exceed 100,000 yen.',
            'grade.in' => 'Invalid grade selected.',
            'description.max' => 'Description must be within 120 characters.',
        ];
    }

}
