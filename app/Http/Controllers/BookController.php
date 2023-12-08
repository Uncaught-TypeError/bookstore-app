<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\MyCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function bookDetail(Book $book)
    {
        return view('frontend.book.bookdetails')->with('book', $book);
    }

    public function listBooks()
    {
        $books = Book::all();
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

    public function putCart($id)
    {
        $user_id = Auth::user()->id;
        $myCart = new MyCart();

        $myCart->user_id = $user_id;
        $myCart->book_id = $id;

        $myCart->save();
        return back();
    }

    public function removeCart($id)
    {
        $user_id = Auth::user()->id;
        $bookInCart = MyCart::where('user_id', $user_id)
            ->where('book_id', $id)
            ->first();

        $bookInCart->delete();
        return back();
    }
}
