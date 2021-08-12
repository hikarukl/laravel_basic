<?php

namespace Database\Seeders;

use App\Models\AdminHasMenu;
use App\Models\RoleHasMenu;
use Illuminate\Database\Seeder;

class RoleHasMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleHasMenu::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'role_id'       => 2,
                'admin_menu_id' => 1,
            ],
            [
                'role_id'       => 2,
                'admin_menu_id' => 2,
            ],
            [
                'role_id'       => 2,
                'admin_menu_id' => 3,
            ],
            [
                'role_id'       => 2,
                'admin_menu_id' => 4,
            ]
        ];
    }
}
