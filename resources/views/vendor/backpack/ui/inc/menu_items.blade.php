{{-- This file is used for menu items by any Backpack v7 theme --}}
@php
    $user = backpack_user();
@endphp

<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>

@if($user && ($user->can('core.cities.view') || $user->can('core.branches.view') || $user->can('core.departments.view') || $user->can('core.job_titles.view') || $user->can('core.branch_departments.view') || $user->can('core.branch_job_titles.view')))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
            <i class="la la-globe nav-icon"></i> {{ __('Core') }}
        </a>
        <div class="dropdown-menu dropdown-menu-arrow">
            @if($user->can('core.cities.view'))
                <a class="dropdown-item" href="{{ backpack_url('cities') }}">
                    <i class="la la-city nav-icon me-2"></i> {{ __('core::crud.cities') }}
                </a>
            @endif
            @if($user->can('core.branches.view'))
                <a class="dropdown-item" href="{{ backpack_url('branches') }}">
                    <i class="la la-building nav-icon me-2"></i> {{ __('core::crud.branches') }}
                </a>
            @endif
            @if($user->can('core.departments.view'))
                <a class="dropdown-item" href="{{ backpack_url('departments') }}">
                    <i class="la la-sitemap nav-icon me-2"></i> {{ __('core::crud.departments') }}
                </a>
            @endif
            @if($user->can('core.job_titles.view'))
                <a class="dropdown-item" href="{{ backpack_url('job-titles') }}">
                    <i class="la la-id-badge nav-icon me-2"></i> {{ __('core::crud.job_titles') }}
                </a>
            @endif
            @if($user->can('core.branch_departments.view'))
                <a class="dropdown-item" href="{{ backpack_url('branch-departments') }}">
                    <i class="la la-random nav-icon me-2"></i> {{ __('core::crud.branch_departments') }}
                </a>
            @endif
            @if($user->can('core.branch_job_titles.view'))
                <a class="dropdown-item" href="{{ backpack_url('branch-job-titles') }}">
                    <i class="la la-briefcase nav-icon me-2"></i> {{ __('core::crud.branch_job_titles') }}
                </a>
            @endif
        </div>
    </li>
@endif

@if($user && ($user->can('hr.employees.view') || $user->can('hr.employee_phones.view') || $user->can('hr.employee_identities.view') || $user->can('hr.employee_licenses.view') || $user->can('hr.employee_bank_accounts.view') || $user->can('hr.employee_files.view')))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button" aria-expanded="false">
            <i class="la la-users nav-icon"></i> {{ __('HR') }}
        </a>
        <div class="dropdown-menu dropdown-menu-arrow">
            @if($user->can('hr.employees.view'))
                <a class="dropdown-item" href="{{ backpack_url('employees') }}">
                    <i class="la la-user-tie nav-icon me-2"></i> {{ __('hr::crud.employees') }}
                </a>
            @endif
            @if($user->can('hr.employee_phones.view'))
                <a class="dropdown-item" href="{{ backpack_url('employee-phones') }}">
                    <i class="la la-phone nav-icon me-2"></i> {{ __('hr::crud.employee_phones') }}
                </a>
            @endif
            @if($user->can('hr.employee_identities.view'))
                <a class="dropdown-item" href="{{ backpack_url('employee-identities') }}">
                    <i class="la la-id-card nav-icon me-2"></i> {{ __('hr::crud.employee_identities') }}
                </a>
            @endif
            @if($user->can('hr.employee_licenses.view'))
                <a class="dropdown-item" href="{{ backpack_url('employee-licenses') }}">
                    <i class="la la-certificate nav-icon me-2"></i> {{ __('hr::crud.employee_licenses') }}
                </a>
            @endif
            @if($user->can('hr.employee_bank_accounts.view'))
                <a class="dropdown-item" href="{{ backpack_url('employee-bank-accounts') }}">
                    <i class="la la-credit-card nav-icon me-2"></i> {{ __('hr::crud.employee_bank_accounts') }}
                </a>
            @endif
            @if($user->can('hr.employee_files.view'))
                <a class="dropdown-item" href="{{ backpack_url('employee-files') }}">
                    <i class="la la-file nav-icon me-2"></i> {{ __('hr::crud.employee_files') }}
                </a>
            @endif
        </div>
    </li>
@endif
