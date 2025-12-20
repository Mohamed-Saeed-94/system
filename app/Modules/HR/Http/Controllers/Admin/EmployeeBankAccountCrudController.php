<?php

namespace App\Modules\HR\Http\Controllers\Admin;

use App\Modules\HR\Http\Requests\EmployeeBankAccountRequest;
use App\Modules\HR\Models\EmployeeBankAccount;
use App\Modules\HR\Support\Permissions\HandlesCrudPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class EmployeeBankAccountCrudController extends CrudController
{
    use HandlesCrudPermissions;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected string $permissionPrefix = 'hr.employee_bank_accounts';

    public function setup(): void
    {
        CRUD::setModel(EmployeeBankAccount::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/employee-bank-accounts');
        CRUD::setEntityNameStrings(__('hr::crud.employee_bank_account'), __('hr::crud.employee_bank_accounts'));

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
        CRUD::column('name_in_bank')->label(__('hr::crud.name_in_bank'));
        CRUD::column('bank_name')->label(__('hr::crud.bank_name'));
        CRUD::column('account_number')->label(__('hr::crud.account_number'));
        CRUD::column('iban')->label(__('hr::crud.iban'));
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(EmployeeBankAccountRequest::class);

        CRUD::addField([
            'name' => 'employee_id',
            'label' => __('hr::crud.employee'),
            'type' => 'select2',
            'entity' => 'employee',
            'attribute' => 'full_name',
            'model' => 'App\\Modules\\HR\\Models\\Employee',
        ]);
        CRUD::field('name_in_bank')->label(__('hr::crud.name_in_bank'));
        CRUD::field('bank_name')->label(__('hr::crud.bank_name'));
        CRUD::field('account_number')->label(__('hr::crud.account_number'));
        CRUD::field('iban')->label(__('hr::crud.iban'));
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
