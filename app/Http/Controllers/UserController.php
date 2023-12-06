<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
