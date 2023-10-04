<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'author' => 'required|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'The field is required.',
            'author.string' => 'The field needs string only!',
            'author.max' => 'The field do not need more than 100 chars!'
        ];
    }
}
