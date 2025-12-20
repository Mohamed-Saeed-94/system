<?php

namespace App\Modules\HR\Http\Controllers\Admin;

use App\Modules\HR\Http\Requests\EmployeeRequest;
use App\Modules\HR\Models\Employee;
use App\Modules\HR\Support\Permissions\HandlesCrudPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeeCrudController extends CrudController
{
    use HandlesCrudPermissions;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected string $permissionPrefix = 'hr.employees';

    public function setup(): void
    {
        CRUD::setModel(Employee::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/employees');
        CRUD::setEntityNameStrings(__('hr::crud.employee'), __('hr::crud.employees'));

        $this->applyCrudPermissions($this->permissionPrefix);
    }

    protected function setupListOperation(): void
    {
        CRUD::column('name')->label(__('hr::crud.name'));
        CRUD::column('name_en')->label(__('hr::crud.name_en'));
        CRUD::column('hire_date')->label(__('hr::crud.hire_date'));
        CRUD::addColumn([
            'name' => 'branch_id',
            'label' => __('hr::crud.branch'),
            'type' => 'select',
            'entity' => 'branch',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Branch',
        ]);
        CRUD::addColumn([
            'name' => 'department_id',
            'label' => __('hr::crud.department'),
            'type' => 'select',
            'entity' => 'department',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Department',
        ]);
        CRUD::addColumn([
            'name' => 'job_title_id',
            'label' => __('hr::crud.job_title'),
            'type' => 'select',
            'entity' => 'jobTitle',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\JobTitle',
        ]);
        CRUD::addColumn([
            'name' => 'nationality_id',
            'label' => __('hr::crud.nationality'),
            'type' => 'select',
            'entity' => 'nationality',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Nationality',
        ]);
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => __('hr::crud.is_active'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(EmployeeRequest::class);

        CRUD::field('name')->label(__('hr::crud.name'));
        CRUD::field('name_en')->label(__('hr::crud.name_en'));
        CRUD::field('hire_date')->type('date')->label(__('hr::crud.hire_date'));

        CRUD::addField([
            'name' => 'branch_id',
            'label' => __('hr::crud.branch'),
            'type' => 'select2',
            'entity' => 'branch',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Branch',
        ]);

        CRUD::addField([
            'name' => 'department_id',
            'label' => __('hr::crud.department'),
            'type' => 'select2_from_ajax',
            'entity' => 'department',
            'attribute' => 'name',
            'data_source' => route('hr.lookups.departments'),
            'placeholder' => __('hr::crud.select_department'),
            'dependencies' => ['branch_id'],
            'include_all_form_fields' => true,
        ]);

        CRUD::addField([
            'name' => 'job_title_id',
            'label' => __('hr::crud.job_title'),
            'type' => 'select2_from_ajax',
            'entity' => 'jobTitle',
            'attribute' => 'name',
            'data_source' => route('hr.lookups.jobTitles'),
            'placeholder' => __('hr::crud.select_job_title'),
            'dependencies' => ['branch_id', 'department_id'],
            'include_all_form_fields' => true,
        ]);

        CRUD::addField([
            'name' => 'nationality_id',
            'label' => __('hr::crud.nationality'),
            'type' => 'select2',
            'entity' => 'nationality',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Nationality',
            'placeholder' => __('hr::crud.select_nationality'),
        ]);

        CRUD::addField([
            'name' => 'is_active',
            'label' => __('hr::crud.is_active'),
            'type' => 'checkbox',
            'default' => true,
        ]);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
