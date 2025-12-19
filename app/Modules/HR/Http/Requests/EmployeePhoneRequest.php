<?php

namespace App\Modules\HR\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeePhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'phone' => ['required', 'string', 'max:50'],
            'type' => ['nullable', 'string', 'max:50'],
        ];
    }
}

