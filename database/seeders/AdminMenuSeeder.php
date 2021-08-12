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
                'name'      => 'Dashboard',
                'slug'      => 'dashboard',
                'route'     => NULL,
                'icon_config'  => json_encode([
                    'type'  => 'font-awesome',
                    'value' => '<i class="fa fa-home" aria-hidden="true"></i>'
                ]),
                'priority'  => 1,
                'is_root'   => 1,
            ],
            [
                'name'      => 'Management',
                'slug'      => 'management',
                'route'     => NULL,
                'icon_config'  => json_encode([
                    'type'  => 'font-awesome',
                    'value' => '<i class="fa fa-bars" aria-hidden="true"></i>'
                ]),
                'priority'  => 2,
                'is_root'   => 1,
            ],
            [
                'name'      => 'Category',
                'slug'      => 'admin-category',
                'route'     => 'admin-category.index',
                'icon_config'  => NULL,
                'priority'  => 1,
                'is_root'   => 0,
            ],
            [
                'name'      => 'Posts',
                'slug'      => 'admin-post',
                'route'     => 'admin-post.index',
                'icon_config'  => NULL,
                'priority'  => 2,
                'is_root'   => 0,
            ]
        ];
    }
}
