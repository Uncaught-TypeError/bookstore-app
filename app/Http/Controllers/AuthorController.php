<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorRepository;
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    public function index()
    {
        $authors = $this->authorRepository->famous();
        $author = null;
        return view("author.index")
            ->with("author", $author)
            ->with('authors', $authors);
    }

    public function show($authorId)
    {
        $author = $this->authorRepository->findById($authorId);
        $authors = null;
        return view("author.index")
            ->with('authors', $authors)
            ->with('author', $author);
    }
}
