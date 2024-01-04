<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface AuthorRepositoryInterface
{
    public function famous(): Collection;
    public function findById($id);
}
