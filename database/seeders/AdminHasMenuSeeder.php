<?php

namespace Database\Seeders;

use App\Models\AdminHasMenu;
use Illuminate\Database\Seeder;

class AdminHasMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminHasMenu::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'admin_id'  => 1,
                'menu_id'   => 1,
            ]
        ];
    }
}
