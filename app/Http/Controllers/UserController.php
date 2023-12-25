<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Checkout;
use App\Models\CheckoutBooks;
use App\Models\MyCart;
use App\Service\BookService;
use App\Service\MyCartService;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $bookService;
    protected $myCartService;
    public function __construct(BookService $bookService, MyCartService $myCartService)
    {
        $this->bookService = $bookService;
        $this->myCartService = $myCartService;
    }
    public function homepage()
    {
        return view('user.homepage');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function library(UserService $userService)
    {
        $allBooks = $userService->getUserLibrary();
        return view('user.library', ['allBooks' => $allBooks]);
    }

    public function downloadPdf($book_id)
    {
        $fileContent = $this->bookService->getFileContent($book_id);
        return response($fileContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $book_id . '.pdf"');
    }

    public function viewPdf($book_id)
    {
        $fileContent = $this->bookService->getFileContent($book_id);
        return response()->stream(
            fn () => print($fileContent),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $book_id . '.pdf"',
            ]
        );
    }
    public function userCart()
    {
        $usercartData = $this->myCartService->getUserCart();
        return view('user.usercart')->with($usercartData);
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
