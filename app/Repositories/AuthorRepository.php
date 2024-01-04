<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function famous()
    {
        $query = $this->famousCheck();
        $query = $this->followerCheck($query);

        return $query->orderBy('name')->get();
    }

    public function findById($id)
    {
        $query = $this->famousCheck();
        $query = $this->followerCheck($query);
        return $query->where('id', $id)->firstOrFail();
    }

    protected function famousCheck()
    {
        return Author::where('famous', 1);
    }

    protected function followerCheck()
    {
        return Author::where(function ($query) {
            $query->where('followers', '>', 1000);
        });
    }
}
