<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HR\Http\Controllers\Admin\EmployeeCrudController;
use App\Modules\HR\Http\Controllers\Admin\EmployeePhoneCrudController;
use App\Modules\HR\Http\Controllers\Admin\EmployeeIdentityCrudController;
use App\Modules\HR\Http\Controllers\Admin\EmployeeLicenseCrudController;
use App\Modules\HR\Http\Controllers\Admin\EmployeeBankAccountCrudController;
use App\Modules\HR\Http\Controllers\Admin\EmployeeFileCrudController;
use App\Modules\HR\Http\Controllers\Support\LookupController;

Route::crud('employees', EmployeeCrudController::class);
Route::crud('employee-phones', EmployeePhoneCrudController::class);
Route::crud('employee-identities', EmployeeIdentityCrudController::class);
Route::crud('employee-licenses', EmployeeLicenseCrudController::class);
Route::crud('employee-bank-accounts', EmployeeBankAccountCrudController::class);
Route::crud('employee-files', EmployeeFileCrudController::class);

Route::get('hr/lookups/departments', [LookupController::class, 'departments'])->name('hr.lookups.departments');
Route::get('hr/lookups/job-titles', [LookupController::class, 'jobTitles'])->name('hr.lookups.jobTitles');

