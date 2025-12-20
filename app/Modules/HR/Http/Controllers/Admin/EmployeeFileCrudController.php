<?php

namespace App\Modules\HR\Http\Controllers\Admin;

use App\Modules\HR\Http\Requests\EmployeeFileRequest;
use App\Modules\HR\Models\EmployeeFile;
use App\Modules\HR\Support\Permissions\HandlesCrudPermissions;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

class EmployeeFileCrudController extends CrudController
{
    use HandlesCrudPermissions;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected string $permissionPrefix = 'hr.employee_files';

    public function setup(): void
    {
        CRUD::setModel(EmployeeFile::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/employee-files');
        CRUD::setEntityNameStrings(__('hr::crud.employee_file'), __('hr::crud.employee_files'));

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
        CRUD::column('file_name')->label(__('hr::crud.file_name'));
        CRUD::column('category')->label(__('hr::crud.category'));
        CRUD::column('side')->label(__('hr::crud.side'));
        CRUD::addColumn([
            'name' => 'is_primary',
            'label' => __('hr::crud.is_primary'),
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(EmployeeFileRequest::class);

        CRUD::addField([
            'name' => 'employee_id',
            'label' => __('hr::crud.employee'),
            'type' => 'relationship',
            'entity' => 'employee',
            'attribute' => 'full_name',
            'model' => 'App\\Modules\\HR\\Models\\Employee',
            'ajax' => true,
        ]);
        CRUD::addField([
            'name' => 'file_upload',
            'label' => __('hr::crud.file'),
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
        ]);
        CRUD::field('category')->label(__('hr::crud.category'));
        CRUD::field('side')->label(__('hr::crud.side'));
        CRUD::addField([
            'name' => 'is_primary',
            'label' => __('hr::crud.is_primary'),
            'type' => 'checkbox',
        ]);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $this->handleFileUpload();

        return $this->traitStore();
    }

    public function update()
    {
        $this->handleFileUpload();

        return $this->traitUpdate();
    }

    protected function handleFileUpload(): void
    {
        $request = $this->crud->getRequest();

        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $path = $file->store('employee_files', 'public');

            $request->merge([
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'fileable_type' => 'App\\Modules\\HR\\Models\\Employee',
                'fileable_id' => $request->input('employee_id'),
            ]);
        }
    }
}
