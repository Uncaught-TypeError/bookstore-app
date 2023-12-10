<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Checkout;
use App\Models\CheckoutBooks;
use App\Models\MyCart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function homepage()
    {
        return view('user.homepage');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function library()
    {
        $checkouts = Checkout::where('user_id', Auth::user()->id)->get();
        // dd($checkouts);

        $allBooks = new Collection();

        foreach ($checkouts as $checkout) {
            $checkoutId = $checkout->id;
            $checkoutBooks = CheckoutBooks::where('checkout_id', $checkoutId)->get();
            // dd($checkoutBooks);
            foreach ($checkoutBooks as $checkoutBook) {
                $book = $checkoutBook->books;
                $allBooks->push($book);
            }
        }

        // Use unique method after merging all books to avoid duplicates
        $allBooks = $allBooks->unique('id');

        return view('user.library', ['allBooks' => $allBooks]);
    }

    public function downloadPdf($book_id)
    {
        $book = Book::findOrFail($book_id);
        $filePath = $book->book_file;

        // Use the 'public' disk to get the file
        $fileContent = Storage::disk('public')->get($filePath);

        return response($fileContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $book->book_file . '.pdf"');
    }

    public function viewPdf($book_id)
    {
        $book = Book::findOrFail($book_id);
        $filePath = $book->book_file;

        $fileContent = Storage::disk('public')->get($filePath);

        return response()->stream(
            fn () => print($fileContent),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $book->book_file . '.pdf"',
            ]
        );
    }



    public function userCart()
    {
        $user_id = Auth::user()->id;
        $cart_empty = 0;
        $bookinCarts = MyCart::where('user_id', $user_id)->get();
        if ($bookinCarts->isEmpty()) {
            $cart_empty = 1;
        }
        return view('user.usercart')
            ->with('bookinCarts', $bookinCarts)
            ->with('cart_empty', $cart_empty);
    }

    public function userCheckout(Request $request)
    {
        try {
            $checkout = Checkout::create([
                'user_id' => Auth::user()->id,
                'total_cost' => $request->input('totalCheckOutPrice'),
            ]);
            $bookIds = session('cart_bookIds', []);

            foreach ($bookIds as $bookId) {
                CheckoutBooks::create([
                    'checkout_id' => $checkout->id,
                    'book_id' => $bookId,
                ]);
            }

            session()->forget('cart_bookIds');

            $bookinCarts = MyCart::where('user_id', Auth::user()->id)->get();
            foreach ($bookinCarts as $item) {
                $item->delete();
            }

            return view('thankyou');
        } catch (\Exception $e) {
            // Handle any exception that might occur during checkout creation
            return redirect()->route('user.cart')->with('error', 'Checkout failed. Please try again.');
        }
    }
}
