<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function homepage()
    {
        return view('admin.homepage');
    }
    public function uploadBooks()
    {
        return view('admin.frontend.upload_books');
    }
}
