<?php

namespace App\Modules\Core\Http\Controllers\Admin;

use App\Modules\Core\Http\Requests\JobTitleRequest;
use App\Modules\Core\Models\JobTitle;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class JobTitleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(JobTitle::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/job-titles');
        CRUD::setEntityNameStrings(__('core::crud.job_title'), __('core::crud.job_titles'));
    }

    protected function setupListOperation(): void
    {
        CRUD::column('name')->label(__('core::crud.name'));
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
        CRUD::setValidation(JobTitleRequest::class);
        CRUD::field('name')->label(__('core::crud.name'));
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

