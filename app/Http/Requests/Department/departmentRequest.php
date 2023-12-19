<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class departmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'department.required'    => 'please fill department',
        ];
    }

    public function messages() {
        return [
            'department.required'    => 'please fill department',
        ];
    }
}
