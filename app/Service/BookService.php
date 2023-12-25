<?php

namespace App\Service;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookService
{
    public function getAllBooks()
    {
        return Book::all();
    }

    public function findBook($id)
    {
        return Book::findOrFail($id);
    }

    public function getFileContent($book_id)
    {
        $book = $this->findBook($book_id);
        $filePath = $book->book_file;
        return Storage::disk('public')->get($filePath);
    }
}
