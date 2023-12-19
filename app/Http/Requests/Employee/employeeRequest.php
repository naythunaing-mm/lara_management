<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class employeeRequest extends FormRequest
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
            'name.required'          => 'please fill name',
            'email.required'         => 'please fill email',
            'phone.required'         => 'please fill phone',
            'password.required'      => 'please fill password',
            'nrc_number.required'    => 'please fill NRC number',
            'birthday.required'      => 'please fill birthday',
            'gender.required'        => 'please fill gender',
            'address.required'       => 'please fill address',
            'employee_id.required'   => 'please fill employee_id',
            'department_id.required' => 'please fill department_id',
            'date_of_join.required'  => 'please fill date_of_join',
            'status.required'        => 'please fill status',
        ];
    }
}
