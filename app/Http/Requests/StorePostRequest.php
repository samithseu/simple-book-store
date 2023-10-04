<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required',
            'author_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The field is required.',
            'title.string' => 'The field needs string only!',
            'title.max' => 'The field do not need more than 255 chars!',
            'body.required' => 'The field is required.',
            'author_id.required' => 'The field is required.'
        ];
    }
}
