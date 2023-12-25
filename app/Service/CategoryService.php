<?php

namespace App\Service;

use App\Models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory($validated)
    {
        return Category::create($validated);
    }
}
