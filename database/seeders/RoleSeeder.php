<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'name'      => 'Admin',
            ],
            [
                'name'      => 'User',
            ]
        ];
    }
}
