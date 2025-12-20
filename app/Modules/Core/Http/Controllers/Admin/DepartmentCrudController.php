<?php

namespace App\Modules\Core\Http\Controllers\Admin;

use App\Modules\Core\Http\Requests\DepartmentRequest;
use App\Modules\Core\Models\Department;
use App\Modules\Core\Support\Permissions\HandlesCrudPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class DepartmentCrudController extends CrudController
{
    use HandlesCrudPermissions;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected string $permissionPrefix = 'core.departments';

    public function setup(): void
    {
        CRUD::setModel(Department::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/departments');
        CRUD::setEntityNameStrings(__('core::crud.department'), __('core::crud.departments'));

        $this->applyCrudPermissions($this->permissionPrefix);
    }

    protected function setupListOperation(): void
    {
        CRUD::column('name')->label(__('core::crud.name'));
        CRUD::column('name_en')->label(__('core::crud.name_en'));
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(DepartmentRequest::class);
        CRUD::field('name')->label(__('core::crud.name'));
        CRUD::field('name_en')->label(__('core::crud.name_en'));
        CRUD::addField([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'checkbox',
            'default' => true,
        ]);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
