<?php

namespace App\QueryFilters;

use Closure;

class SearchByBookName extends FilterPipeline
{
    protected function applyFilter($builder)
    {
        return $builder->where('book_name', 'LIKE', '%' . request('data') . '%');
    }
}
