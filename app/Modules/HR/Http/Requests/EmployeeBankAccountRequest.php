<?php

namespace App\Modules\HR\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeBankAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'bank_name' => ['nullable', 'string', 'max:150'],
            'account_number' => ['required', 'string', 'max:150'],
            'iban' => ['nullable', 'string', 'max:150'],
        ];
    }
}

