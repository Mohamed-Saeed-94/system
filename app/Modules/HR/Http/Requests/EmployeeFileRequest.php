<?php

namespace App\Modules\HR\Http\Requests;

use App\Modules\HR\Models\EmployeeFile;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'file_upload' => [$this->isMethod('post') ? 'required' : 'nullable', 'file'],
            'category' => ['nullable', 'string', 'max:150'],
            'side' => ['nullable', 'string', 'max:50'],
            'is_primary' => ['boolean'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            if ($this->boolean('is_primary') && $this->input('category') === 'employee_photo') {
                $exists = EmployeeFile::where('employee_id', $this->input('employee_id'))
                    ->where('category', 'employee_photo')
                    ->where('is_primary', true)
                    ->when($this->route('id'), fn ($q) => $q->where('id', '!=', $this->route('id')))
                    ->exists();

                if ($exists) {
                    $v->errors()->add('is_primary', __('hr::validation.employee_primary_photo_unique'));
                }
            }
        });
    }
}

