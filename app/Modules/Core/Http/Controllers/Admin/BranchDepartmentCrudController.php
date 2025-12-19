<?php

namespace App\Modules\Core\Http\Controllers\Admin;

use App\Modules\Core\Http\Requests\BranchDepartmentRequest;
use App\Modules\Core\Models\BranchDepartment;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BranchDepartmentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(BranchDepartment::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/branch-departments');
        CRUD::setEntityNameStrings(__('core::crud.branch_department'), __('core::crud.branch_departments'));
    }

    protected function setupListOperation(): void
    {
        CRUD::addColumn([
            'name' => 'branch_id',
            'label' => __('core::crud.branch'),
            'type' => 'select',
            'entity' => 'branch',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Branch',
        ]);
        CRUD::addColumn([
            'name' => 'department_id',
            'label' => __('core::crud.department'),
            'type' => 'select',
            'entity' => 'department',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Department',
        ]);
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(BranchDepartmentRequest::class);

        CRUD::addField([
            'name' => 'branch_id',
            'label' => __('core::crud.branch'),
            'type' => 'select',
            'entity' => 'branch',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Branch',
        ]);
        CRUD::addField([
            'name' => 'department_id',
            'label' => __('core::crud.department'),
            'type' => 'select',
            'entity' => 'department',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Department',
        ]);
        CRUD::addField([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'checkbox',
        ]);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}

