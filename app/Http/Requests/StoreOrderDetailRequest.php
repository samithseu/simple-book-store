<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderDetailRequest extends FormRequest
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
            'book_id' => 'required|regex:/^[0-9]+$/',
            'order_id' => 'required|regex:/^[0-9]+$/',
            'qty' => 'required|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'book_id.required' => 'The field is required!',
            'book_id.regex' => 'The field needs number only!',
            'order_id.required' => 'The field is required!',
            'order_id.regex' => 'The field needs number only!',
            'qty.required' => 'The field is required!',
            'qty.regex' => 'The field needs number only!',
        ];
    }
}
