<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(
            [
                // For frontend
                FrontendMenuSeeder::class,
                CategorySeeder::class,
                // For admin
                RoleSeeder::class,
                PermissionSeeder::class,
                AdminSeeder::class,
                RoleHasPermissionSeeder::class,
                AdminHasRoleSeeder::class,
                AdminHasPermissionSeeder::class,
                AdminMenuSeeder::class,
                AdminHasMenuSeeder::class,
                AdminMenuRelationSeeder::class,
                RoleHasMenuSeeder::class,
            ]
        );
    }
}
