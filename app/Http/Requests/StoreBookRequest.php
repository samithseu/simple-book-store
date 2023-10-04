<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'name' => 'required|unique:books|string',
            'unit_price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'author_name' => 'required|string'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'This field is required!',
            'name.unique' => 'The value in this field must be unique!',
            'name.string' => 'This field needs string only!',
            'unit_price.required' => 'This field is required!',
            'unit_price.regex' => 'The value in this field must be decimal! Ex: 12.50',
            'author_name.required' => 'This field is required!',
            'author_name.string' => 'This field needs string only!'
        ];
    }
}
