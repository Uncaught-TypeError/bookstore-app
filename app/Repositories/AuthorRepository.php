<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function famous(): Collection
    {
        $query = Author::query();
        $query = $this->famousCheck($query);
        $query = $this->followerCheck($query);
        return $query->orderBy('name')->get();
    }

    public function findById($id)
    {
        $query = Author::query();
        $query = $this->famousCheck($query);
        $query = $this->followerCheck($query);
        return $query->where('id', $id)->firstOrFail();
    }

    protected function famousCheck(Builder $query)
    {
        return $query->where('famous', 1);
    }

    protected function followerCheck(Builder $query)
    {
        return $query->where('followers', '>', 1000);
    }
}
