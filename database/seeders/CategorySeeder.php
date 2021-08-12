<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'name'              => 'PHP',
                'slug'              => 'php',
                'priority'          => 1,
                'frontend_menu_id'  => 2,
                'route'             => 'category.show',
                'route_params'      => json_encode(['category' => 'php'])
            ],
            [
                'name'              => 'Javascript',
                'slug'              => 'javascript',
                'priority'          => 2,
                'frontend_menu_id'  => 2,
                'route'             => 'category.show',
                'route_params'      => json_encode(['category' => 'javascript'])
            ],

            [
                'name'              => 'Html',
                'slug'              => 'html',
                'priority'          => 3,
                'frontend_menu_id'  => 2,
                'route'             => 'category.show',
                'route_params'      => json_encode(['category' => 'html'])
            ],
            [
                'name'              => 'Css',
                'slug'              => 'css',
                'priority'          => 4,
                'frontend_menu_id'  => 2,
                'route'             => 'category.show',
                'route_params'      => json_encode(['category' => 'css'])
            ]
        ];
    }
}
