<?php

namespace App\Service;

use App\Models\MyCart;
use Illuminate\Support\Facades\Auth;

class MyCartService
{
    public function addToCart($user_id, $bookId)
    {
        $myCart = new MyCart();

        $myCart->user_id = $user_id;
        $myCart->book_id = $bookId;

        $myCart->save();
    }
    public function removeFromCart($user_id, $bookId)
    {
        $bookInCart = $this->getUserBookFromCart($user_id, $bookId);

        if ($bookInCart) {
            $bookInCart->delete();
        }
    }

    public function getUserCart()
    {
        $user_id = Auth::user()->id;
        $cart_empty = 0;
        $bookinCarts = $this->getUserIdFromCart($user_id);

        if ($bookinCarts->isEmpty()) {
            $cart_empty = 1;
        }

        return ['bookinCarts' => $bookinCarts, 'cart_empty' => $cart_empty];
    }

    private function getUserIdFromCart($user_id)
    {
        return MyCart::where('user_id', $user_id)->get();
    }

    private function getUserBookFromCart($user_id, $book_id)
    {
        return MyCart::where('user_id', $user_id)
            ->where('book_id', $book_id)
            ->first();
    }
}
