<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentValidationRequest extends FormRequest
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
            'id_number' => ['required', 'regex:/^pc\d{2}-\d{1,9}$/', Rule::unique('students', 'id_number')],
            'name' => ['required', 'string'],
            'class_id' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:15', 'confirmed'],
            'password_confirmation' => ['required', 'min:6', 'max:15']
        ];
    }

    public function messages()
{
    return [
        'id_number.regex' => 'The ID number must follow the pattern "pcxx-xxxxx".',
    ];
}
}
