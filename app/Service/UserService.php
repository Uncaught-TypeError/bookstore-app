<?php

namespace App\Service;

use App\Models\Checkout;
use App\Models\CheckoutBooks;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUserLibrary()
    {
        $checkouts = Checkout::where('user_id', Auth::user()->id)->get();

        $allBooks = new Collection();

        foreach ($checkouts as $checkout) {
            $checkoutId = $checkout->id;
            $checkoutBooks = CheckoutBooks::where('checkout_id', $checkoutId)->get();

            foreach ($checkoutBooks as $checkoutBook) {
                $book = $checkoutBook->books;
                $allBooks->push($book);
            }
        }
        return $allBooks->unique('id');
    }
}
