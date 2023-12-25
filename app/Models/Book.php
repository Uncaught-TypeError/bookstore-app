<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['book_name', 'book_desc', 'book_image', 'book_author', 'book_price'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class,  'taggable');
    }
}
