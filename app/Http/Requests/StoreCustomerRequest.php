<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required|unique:customers|string',
            'address' => 'required|string',
            'phone' => 'required|unique:customers'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'This field is required!',
            'name.unique' => 'The value in this field must be unique!',
            'name.string' => 'This field needs string only!',
            'address.required' => 'This field is required!',
            'address.string' => 'This field needs string only!',
            'phone.required' => 'This field is required!',
            'phone.unique' => 'The value in this field must be unique!',
        ];
    }
}
