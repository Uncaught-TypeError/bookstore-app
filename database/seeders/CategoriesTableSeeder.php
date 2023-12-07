<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'No Category'],
            ['category_name' => 'Horror'],
            ['category_name' => 'Comedy'],
            ['category_name' => 'Drama'],
            ['category_name' => 'Romance'],
            ['category_name' => 'Thriller'],
            ['category_name' => 'Action'],
        ];

        Category::insert($categories);
    }
}
