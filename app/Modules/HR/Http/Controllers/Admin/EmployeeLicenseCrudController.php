<?php

namespace App\Modules\HR\Http\Controllers\Admin;

use App\Modules\HR\Http\Requests\EmployeeLicenseRequest;
use App\Modules\HR\Models\EmployeeLicense;
use App\Modules\HR\Support\Permissions\HandlesCrudPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeeLicenseCrudController extends CrudController
{
    use HandlesCrudPermissions;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected string $permissionPrefix = 'hr.employee_licenses';

    public function setup(): void
    {
        CRUD::setModel(EmployeeLicense::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/employee-licenses');
        CRUD::setEntityNameStrings(__('hr::crud.employee_license'), __('hr::crud.employee_licenses'));

        $this->applyCrudPermissions($this->permissionPrefix);
    }

    protected function setupListOperation(): void
    {
        CRUD::addColumn([
            'name' => 'employee_id',
            'label' => __('hr::crud.employee'),
            'type' => 'select',
            'entity' => 'employee',
            'attribute' => 'full_name',
            'model' => 'App\\Modules\\HR\\Models\\Employee',
        ]);
        CRUD::column('license_number')->label(__('hr::crud.license_number'));
        CRUD::column('type')->label(__('hr::crud.type'));
        CRUD::column('issued_at')->label(__('hr::crud.issued_at'));
        CRUD::column('expires_at')->label(__('hr::crud.expires_at'));
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(EmployeeLicenseRequest::class);

        CRUD::addField([
            'name' => 'employee_id',
            'label' => __('hr::crud.employee'),
            'type' => 'relationship',
            'entity' => 'employee',
            'attribute' => 'full_name',
            'model' => 'App\\Modules\\HR\\Models\\Employee',
            'ajax' => true,
        ]);
        CRUD::field('license_number')->label(__('hr::crud.license_number'));
        CRUD::field('type')->label(__('hr::crud.type'));
        CRUD::field('issued_at')->type('date')->label(__('hr::crud.issued_at'));
        CRUD::field('expires_at')->type('date')->label(__('hr::crud.expires_at'));
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
