<?php

namespace App\Modules\HR\Support\Permissions;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait HandlesCrudPermissions
{
    protected function applyCrudPermissions(string $permissionPrefix): void
    {
        $user = backpack_user();

        if (! $user) {
            CRUD::denyAccess(['list', 'show', 'create', 'update', 'delete']);

            return;
        }

        if (! $user->can($permissionPrefix.'.view')) {
            CRUD::denyAccess(['list', 'show']);
        }

        if (! $user->can($permissionPrefix.'.create')) {
            CRUD::denyAccess(['create']);
        }

        if (! $user->can($permissionPrefix.'.update')) {
            CRUD::denyAccess(['update']);
        }

        if (! $user->can($permissionPrefix.'.delete')) {
            CRUD::denyAccess(['delete']);
        }
    }
}
