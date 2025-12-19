<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::firstOrCreate(
            ['email' => 'admin@system.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('Admin@123'),
                'email_verified_at' => now(),
            ]
        );
        $hrUser = User::firstOrCreate(
            ['email' => 'hr@system.com'],
            [
                'name' => 'HR User',
                'password' => bcrypt('Hr@123'),
                'email_verified_at' => now(),
            ]
        );
        // $employeeUser = User::firstOrCreate(
        //     ['email' => 'employee@system.com'],
        //     [
        //         'name' => 'Employee User',
        //         'password' => bcrypt('Employee@123'),
        //         'email_verified_at' => now(),
        //     ]
        // );

    }
}
