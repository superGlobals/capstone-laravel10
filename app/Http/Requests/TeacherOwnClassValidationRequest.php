<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class TeacherOwnClassValidationRequest extends FormRequest
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
            'class_id' => [
                'required',
                Rule::unique('teacher_own_classes')->where(function ($query) {
                    return $query->where('subject_id', $this->subject_id);
                }),
            ],
            'subject_id' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'class_id.unique' => 'That class already added'
        ];
    }
}
