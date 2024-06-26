<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:200'
            ],
            'slug' => [
                'string',
                'max:200'
            ],
            'description' => [
                'required'
            ],
            'image' => [
                'nullable',
                'mimes:jpeg,png,bmp,svg'
            ],
            'meta_title' => [
                'nullable'
            ],
            'meta_keyword' => [
                'nullable'
            ],
            'meta_description' => [
                'nullable'
            ]
        ];
    }
}
