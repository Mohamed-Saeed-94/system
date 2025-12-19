<?php

namespace App\Modules\Core\Http\Controllers\Admin;

use App\Modules\Core\Http\Requests\BranchRequest;
use App\Modules\Core\Models\Branch;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BranchCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(Branch::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/branches');
        CRUD::setEntityNameStrings(__('core::crud.branch'), __('core::crud.branches'));
    }

    protected function setupListOperation(): void
    {
        CRUD::column('name')->label(__('core::crud.name'));
        CRUD::column('address')->label(__('core::crud.address'));
        CRUD::addColumn([
            'name' => 'city_id',
            'label' => __('core::crud.city'),
            'type' => 'select',
            'entity' => 'city',
            'attribute' => 'name',
            'model' => Branch::class,
        ]);
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(BranchRequest::class);

        CRUD::field('name')->label(__('core::crud.name'));
        CRUD::field('address')->label(__('core::crud.address'));
        CRUD::addField([
            'name' => 'city_id',
            'label' => __('core::crud.city'),
            'type' => 'select',
            'entity' => 'city',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\City',
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

