<?php

namespace App\Modules\HR\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Modules\Core\Models\BranchDepartment;
use App\Modules\Core\Models\BranchJobTitle;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function departments(Request $request)
    {
        $branchId = $request->get('branch_id');
        $departments = BranchDepartment::with('department')
            ->where('is_active', true)
            ->when($branchId, fn ($q) => $q->where('branch_id', $branchId))
            ->get()
            ->map(fn ($item) => [
                'id' => $item->department_id,
                'text' => $item->department->name,
            ]);

        return response()->json(['results' => $departments]);
    }

    public function jobTitles(Request $request)
    {
        $branchId = $request->get('branch_id');
        $departmentId = $request->get('department_id');

        $jobTitles = BranchJobTitle::with('jobTitle')
            ->where('is_active', true)
            ->when($branchId, fn ($q) => $q->where('branch_id', $branchId))
            ->when($departmentId, function ($q) use ($departmentId) {
                $q->whereHas('jobTitle', fn ($j) => $j->where('department_id', $departmentId));
            })
            ->get()
            ->map(fn ($item) => [
                'id' => $item->job_title_id,
                'text' => $item->jobTitle->name,
            ]);

        return response()->json(['results' => $jobTitles]);
    }
}

