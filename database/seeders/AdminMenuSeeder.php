<?php

namespace Database\Seeders;

use App\Models\AdminMenu;
use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminMenu::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'name'      => 'Admin Management',
                'slug'      => 'admin-management',
                'priority'  => 1
            ]
        ];
    }
}
