<?php

namespace App\Modules\HR\Http\Controllers\Admin;

use App\Modules\HR\Http\Requests\EmployeePhoneRequest;
use App\Modules\HR\Models\EmployeePhone;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeePhoneCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(EmployeePhone::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/employee-phones');
        CRUD::setEntityNameStrings(__('hr::crud.employee_phone'), __('hr::crud.employee_phones'));
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
        CRUD::column('phone')->label(__('hr::crud.phone'));
        CRUD::column('type')->label(__('hr::crud.type'));
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(EmployeePhoneRequest::class);

        CRUD::addField([
            'name' => 'employee_id',
            'label' => __('hr::crud.employee'),
            'type' => 'select2',
            'entity' => 'employee',
            'attribute' => 'full_name',
            'model' => 'App\\Modules\\HR\\Models\\Employee',
        ]);
        CRUD::field('phone')->label(__('hr::crud.phone'));
        CRUD::field('type')->label(__('hr::crud.type'));
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}

