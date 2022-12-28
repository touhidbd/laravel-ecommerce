<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
                'max:100'
            ],
            'email' => [
                'required',
                'max:100',
                'email'
            ],
            'subject' => [
                'required',
                'max:255',
            ],
            'message' => [
                'required',
                'max:1000',
            ],
        ];
    }
}
