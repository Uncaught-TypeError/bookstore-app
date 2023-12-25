<?php

namespace App\Http\Controllers;

use App\Facades\CartFacade;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\MyCart;
use App\Service\BookService;
use App\Service\MyCartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{


    protected $mycartservice;

    public function __construct(MyCartService $cartService)
    {
        $this->mycartservice = $cartService;
    }

    public function bookDetail(Book $book)
    {
        return view('frontend.book.bookdetails')->with('book', $book);
    }

    public function listBooks(BookService $bookService)
    {
        $books = $bookService->getAllBooks();
        return view('admin.frontend.list_books')->with('books', $books);
    }

    public function deleteBooks(Book $book)
    {
        if (!is_null($book->image)) {
            Storage::delete($book->image);
        }

        $book->delete();

        return back()->with('success', 'Book Deleted!');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category Deleted!');
    }

    //Using Custom Facade
    public function putCart($id)
    {
        $user_id = Auth::user()->id;
        CartFacade::addToCart($user_id, $id);
        return back();
    }

    public function removeCart($id)
    {
        $user_id = Auth::user()->id;

        $this->mycartservice->removeFromCart($user_id, $id);

        return back();
    }
}
