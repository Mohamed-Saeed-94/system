<?php

namespace App\Modules\HR\Http\Controllers\Admin;

use App\Modules\HR\Http\Requests\EmployeeIdentityRequest;
use App\Modules\HR\Models\EmployeeIdentity;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeeIdentityCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(EmployeeIdentity::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/employee-identities');
        CRUD::setEntityNameStrings(__('hr::crud.employee_identity'), __('hr::crud.employee_identities'));
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
        CRUD::column('identity_number')->label(__('hr::crud.identity_number'));
        CRUD::column('issued_at')->label(__('hr::crud.issued_at'));
        CRUD::column('expires_at')->label(__('hr::crud.expires_at'));
        CRUD::column('sponsor_name')->label(__('hr::crud.sponsor_name'));
        CRUD::column('sponsor_id_number')->label(__('hr::crud.sponsor_id_number'));
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(EmployeeIdentityRequest::class);

        CRUD::addField([
            'name' => 'employee_id',
            'label' => __('hr::crud.employee'),
            'type' => 'select2',
            'entity' => 'employee',
            'attribute' => 'full_name',
            'model' => 'App\\Modules\\HR\\Models\\Employee',
        ]);
        CRUD::field('identity_number')->label(__('hr::crud.identity_number'));
        CRUD::field('issued_at')->type('date')->label(__('hr::crud.issued_at'));
        CRUD::field('expires_at')->type('date')->label(__('hr::crud.expires_at'));
        CRUD::field('sponsor_name')->label(__('hr::crud.sponsor_name'));
        CRUD::field('sponsor_id_number')->label(__('hr::crud.sponsor_id_number'));
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}

