<?php

namespace App\Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchJobTitleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['required', 'exists:branches,id'],
            'job_title_id' => ['required', 'exists:job_titles,id'],
            'is_active' => ['boolean'],
        ];
    }
}

