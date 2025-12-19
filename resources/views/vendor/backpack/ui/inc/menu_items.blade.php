{{-- This file is used for menu items by any Backpack v7 theme --}}
@php
    $user = backpack_user();
@endphp

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

@if($user && ($user->can('core.cities.view') || $user->can('core.branches.view') || $user->can('core.departments.view') || $user->can('core.job_titles.view') || $user->can('core.branch_departments.view') || $user->can('core.branch_job_titles.view')))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="la la-globe nav-icon"></i> {{ __('Core') }}</a>
        <ul class="nav-dropdown-items">
            @if($user->can('core.cities.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cities') }}"><i class="la la-city nav-icon"></i> {{ __('core::crud.cities') }}</a></li>
            @endif
            @if($user->can('core.branches.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('branches') }}"><i class="la la-building nav-icon"></i> {{ __('core::crud.branches') }}</a></li>
            @endif
            @if($user->can('core.departments.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('departments') }}"><i class="la la-sitemap nav-icon"></i> {{ __('core::crud.departments') }}</a></li>
            @endif
            @if($user->can('core.job_titles.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('job-titles') }}"><i class="la la-id-badge nav-icon"></i> {{ __('core::crud.job_titles') }}</a></li>
            @endif
            @if($user->can('core.branch_departments.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('branch-departments') }}"><i class="la la-random nav-icon"></i> {{ __('core::crud.branch_departments') }}</a></li>
            @endif
            @if($user->can('core.branch_job_titles.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('branch-job-titles') }}"><i class="la la-briefcase nav-icon"></i> {{ __('core::crud.branch_job_titles') }}</a></li>
            @endif
        </ul>
    </li>
@endif

@if($user && ($user->can('hr.employees.view') || $user->can('hr.employee_phones.view') || $user->can('hr.employee_identities.view') || $user->can('hr.employee_licenses.view') || $user->can('hr.employee_bank_accounts.view') || $user->can('hr.employee_files.view')))
    <li class="nav-item nav-dropdown">
        <a class="nav-link nav-dropdown-toggle" href="#"><i class="la la-users nav-icon"></i> {{ __('HR') }}</a>
        <ul class="nav-dropdown-items">
            @if($user->can('hr.employees.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employees') }}"><i class="la la-user-tie nav-icon"></i> {{ __('hr::crud.employees') }}</a></li>
            @endif
            @if($user->can('hr.employee_phones.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-phones') }}"><i class="la la-phone nav-icon"></i> {{ __('hr::crud.employee_phones') }}</a></li>
            @endif
            @if($user->can('hr.employee_identities.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-identities') }}"><i class="la la-id-card nav-icon"></i> {{ __('hr::crud.employee_identities') }}</a></li>
            @endif
            @if($user->can('hr.employee_licenses.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-licenses') }}"><i class="la la-certificate nav-icon"></i> {{ __('hr::crud.employee_licenses') }}</a></li>
            @endif
            @if($user->can('hr.employee_bank_accounts.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-bank-accounts') }}"><i class="la la-credit-card nav-icon"></i> {{ __('hr::crud.employee_bank_accounts') }}</a></li>
            @endif
            @if($user->can('hr.employee_files.view'))
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('employee-files') }}"><i class="la la-file nav-icon"></i> {{ __('hr::crud.employee_files') }}</a></li>
            @endif
        </ul>
    </li>
@endif
