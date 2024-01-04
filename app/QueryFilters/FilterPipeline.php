<?php

namespace App\QueryFilters;

use Closure;

abstract class FilterPipeline
{
    public function handle($request, Closure $next)
    {
        return parent::handle($request, $next);
    }

    protected function applyFilter($builder)
    {
        return $builder->where('book_name', 'LIKE', '%' . request('data') . '%');
    }
}
