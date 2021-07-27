<?php

namespace Database\Seeders;

use App\Models\AdminMenuRelation;
use Illuminate\Database\Seeder;

class AdminMenuRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //AdminMenuRelation::insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                'parent_id' => 1,
                'child_id'  => 2,
            ]
        ];
    }
}
