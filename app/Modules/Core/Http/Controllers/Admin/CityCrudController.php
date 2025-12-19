<?php

namespace App\Modules\Core\Http\Controllers\Admin;

use App\Modules\Core\Http\Requests\CityRequest;
use App\Modules\Core\Models\City;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(City::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/cities');
        CRUD::setEntityNameStrings(__('core::crud.city'), __('core::crud.cities'));
    }

    protected function setupListOperation(): void
    {
        CRUD::column('name')->label(__('core::crud.name'));
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(CityRequest::class);

        CRUD::field('name')->label(__('core::crud.name'));
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

