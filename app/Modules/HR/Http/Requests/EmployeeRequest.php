<?php

namespace App\Modules\HR\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Modules\Core\Models\JobTitle;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'name_en' => ['required', 'string', 'max:100'],
            'hire_date' => ['nullable', 'date'],
            'branch_id' => ['required', 'exists:branches,id'],
            'department_id' => [
                'required',
                Rule::exists('branch_departments', 'department_id')
                    ->where('branch_id', $this->input('branch_id'))
                    ->where('is_active', 1),
            ],
            'job_title_id' => [
                'required',
                Rule::exists('branch_job_titles', 'job_title_id')
                    ->where('branch_id', $this->input('branch_id'))
                    ->where('is_active', 1),
            ],
            'is_active' => ['boolean'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $jobTitleId = $this->input('job_title_id');
            $departmentId = $this->input('department_id');

            if ($jobTitleId && $departmentId) {
                $jobTitle = JobTitle::find($jobTitleId);
                if ($jobTitle && $jobTitle->department_id !== (int) $departmentId) {
                    $v->errors()->add('job_title_id', __('hr::validation.job_title_department_mismatch'));
                }
            }
        });
    }
}
