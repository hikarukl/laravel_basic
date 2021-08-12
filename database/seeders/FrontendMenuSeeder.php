<?php

namespace Database\Seeders;

use App\Models\FrontendMenu;
use Illuminate\Database\Seeder;

class FrontendMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FrontendMenu::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'name'         => 'Home',
                'slug'         => 'home',
                'priority'     => 1,
                'icon_config'  => json_encode([
                    'type'  => 'font-awesome',
                    'value' => '<i class="fa fa-home" aria-hidden="true"></i>'
                ]),
                'route'        => 'home.index'
            ],
            [
                'name'      => 'Categories',
                'slug'      => 'category',
                'priority'  => 2,
                'icon_config'  => json_encode([
                    'type'  => 'font-awesome',
                    'value' => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ]),
                'route'     => null
            ]
        ];
    }
}
