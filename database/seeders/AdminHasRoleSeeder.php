<?php

namespace Database\Seeders;

use App\Models\AdminHasRole;
use Illuminate\Database\Seeder;

class AdminHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminHasRole::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'admin_id' => 1,
                'role_id'  => 1,
            ],
            [
                'admin_id' => 2,
                'role_id'  => 2,
            ]
        ];
    }
}
