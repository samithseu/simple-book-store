<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customer_id' => 'required|regex:/^[0-9]+$/',
            'note' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'This field is required!',
            'customer_id.regex' => 'This field needs number only!',
            'note.string' => 'This field needs string only!'
        ];
    }
}
