<?php

namespace App\Modules\HR\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $guardName = 'web';

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'core' => [
                'cities' => ['view', 'create', 'update', 'delete'],
                'branches' => ['view', 'create', 'update', 'delete'],
                'departments' => ['view', 'create', 'update', 'delete'],
                'job_titles' => ['view', 'create', 'update', 'delete'],
                'branch_departments' => ['view', 'create', 'update', 'delete'],
                'branch_job_titles' => ['view', 'create', 'update', 'delete'],
                'nationalities' => ['view', 'create', 'update', 'delete'],
            ],
            'hr' => [
                'employees' => ['view', 'create', 'update', 'delete'],
                'employee_phones' => ['view', 'create', 'update', 'delete'],
                'employee_identities' => ['view', 'create', 'update', 'delete'],
                'employee_licenses' => ['view', 'create', 'update', 'delete'],
                'employee_bank_accounts' => ['view', 'create', 'update', 'delete'],
                'employee_files' => ['view', 'create', 'update', 'delete'],
            ],
        ];

        foreach ($permissions as $module => $entities) {
            foreach ($entities as $entity => $actions) {
                foreach ($actions as $action) {
                    Permission::firstOrCreate([
                        'name' => $module.'.'.$entity.'.'.$action,
                        'guard_name' => $guardName,
                    ]);
                }
            }
        }

        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => $guardName,
        ]);

        $hrRole = Role::firstOrCreate([
            'name' => 'HR',
            'guard_name' => $guardName,
        ]);

        $adminRole->syncPermissions(Permission::where('guard_name', $guardName)->pluck('name'));

        $hrPermissions = collect($permissions['hr'])
            ->flatMap(fn (array $actions, string $entity) => collect($actions)->map(fn (string $action) => 'hr.'.$entity.'.'.$action))
            ->merge(
                collect($permissions['core'])->map(fn (array $actions, string $entity) => 'core.'.$entity.'.view')
            )
            ->all();

        $hrRole->syncPermissions(Permission::whereIn('name', $hrPermissions)->pluck('name'));

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
