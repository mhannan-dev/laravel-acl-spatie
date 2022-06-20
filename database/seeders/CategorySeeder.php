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
        $categoryRecord = [
            [
                'parent_id' => 0,
                'position' => 0,
                'title' => 'Category One',
                'slug' => 't-shirt',
                'image' => 'def.png',
                'status' => 1
            ],
            [
                'parent_id' => 0,
                'position' => 0,
                'title' => 'Category Two',
                'slug' => 't-two',
                'image' => 'def.png',
                'status' => 1
            ]
        ];
        Category::insert($categoryRecord);
    }
}
