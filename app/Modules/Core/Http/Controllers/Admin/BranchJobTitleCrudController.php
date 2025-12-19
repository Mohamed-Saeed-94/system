<?php

namespace App\Modules\Core\Http\Controllers\Admin;

use App\Modules\Core\Http\Requests\BranchJobTitleRequest;
use App\Modules\Core\Models\BranchJobTitle;
use App\Modules\Core\Support\Permissions\HandlesCrudPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BranchJobTitleCrudController extends CrudController
{
    use HandlesCrudPermissions;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected string $permissionPrefix = 'core.branch_job_titles';

    public function setup(): void
    {
        CRUD::setModel(BranchJobTitle::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/branch-job-titles');
        CRUD::setEntityNameStrings(__('core::crud.branch_job_title'), __('core::crud.branch_job_titles'));

        $this->applyCrudPermissions($this->permissionPrefix);
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
            'name' => 'job_title_id',
            'label' => __('core::crud.job_title'),
            'type' => 'select',
            'entity' => 'jobTitle',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\JobTitle',
        ]);
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => __('core::crud.is_active'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(BranchJobTitleRequest::class);

        CRUD::addField([
            'name' => 'branch_id',
            'label' => __('core::crud.branch'),
            'type' => 'select',
            'entity' => 'branch',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\Branch',
        ]);
        CRUD::addField([
            'name' => 'job_title_id',
            'label' => __('core::crud.job_title'),
            'type' => 'select',
            'entity' => 'jobTitle',
            'attribute' => 'name',
            'model' => 'App\\Modules\\Core\\Models\\JobTitle',
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
