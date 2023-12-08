<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MyCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function userCart()
    {
        $user_id = Auth::user()->id;
        $bookinCarts = MyCart::where('user_id', $user_id)->get();
        return view('user.usercart')->with('bookinCarts', $bookinCarts);
    }
}
