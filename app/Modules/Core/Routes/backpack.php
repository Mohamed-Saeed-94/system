<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Core\Http\Controllers\Admin\CityCrudController;
use App\Modules\Core\Http\Controllers\Admin\BranchCrudController;
use App\Modules\Core\Http\Controllers\Admin\DepartmentCrudController;
use App\Modules\Core\Http\Controllers\Admin\JobTitleCrudController;
use App\Modules\Core\Http\Controllers\Admin\BranchDepartmentCrudController;
use App\Modules\Core\Http\Controllers\Admin\BranchJobTitleCrudController;

Route::crud('cities', CityCrudController::class);
Route::crud('branches', BranchCrudController::class);
Route::crud('departments', DepartmentCrudController::class);
Route::crud('job-titles', JobTitleCrudController::class);
Route::crud('branch-departments', BranchDepartmentCrudController::class);
Route::crud('branch-job-titles', BranchJobTitleCrudController::class);

