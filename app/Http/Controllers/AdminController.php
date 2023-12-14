<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookUpdateValidationRequest;
use App\Http\Requests\BookUploadValidationRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $categories = Category::all();
        return view('admin.frontend.upload_books')->with('categories', $categories);
    }

    public function postBooks(BookUploadValidationRequest $request)
    {
        $book = Book::create([
            'book_name' => $request->book_name,
            'book_desc' => $request->book_desc,
            'book_author' => $request->book_author,
            'book_price' => $request->book_price,
            'book_image' => null,
            'book_file' => null,
        ]);

        $book->categories()->attach($request->input('categories'));

        //Book Image
        // if ($request->hasFile('book_image')) {
        //     $image = $request->file('book_image');
        //     $imagePath = $image->store('public/bookimage');
        //     $image = Image::make(storage_path('app/' . $imagePath))->fit(800, 600);
        //     $image->save();

        //     $filename = str_replace('public/', '', $imagePath);
        //     // dd($filename);
        //     $book->book_image = $filename;
        // } else {
        //     $book->book_image = null;
        // }

        if ($request->hasFile('book_image')) {
            $file = $request->file('book_image');
            $filePath = $file->store('public/bookimages');
            $filename = str_replace('public/', '', $filePath);
            $book->book_image = $filename;
        } else {
            $book->book_image = null;
        }

        //Book File
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $filePath = $file->store('public/bookfiles');
            $filename = str_replace('public/', '', $filePath);
            $book->book_file = $filename;
        } else {
            $book->book_file = null;
        }

        $book->update();

        return redirect()->back()->with('success', 'Book Uploaded Successfully!');
    }

    public function editBooks(Book $book)
    {
        $categories = Category::all();
        return view('admin.frontend.edit_books')->with('book', $book)->with('categories', $categories);
    }

    public function updateBooks(BookUpdateValidationRequest $request, Book $book)
    {
        $book->update([
            'book_name' => $request->book_name,
            'book_desc' => $request->book_desc,
            'book_author' => $request->book_author,
            'book_price' => $request->book_price,
        ]);
        $book->categories()->sync($request->input('categories'));

        // if ($request->hasFile('book_image')) {
        //     $image = $request->file('book_image');
        //     $imagePath = $image->store('public/bookimage');
        //     $image = Image::make(storage_path('app/' . $imagePath))->fit(800, 600);
        //     $image->save();

        //     $filename = str_replace('public/', '', $imagePath);
        //     // dd($filename);
        //     $book->book_image = $filename;
        // }

        if ($request->hasFile('book_image')) {
            $file = $request->file('book_image');
            $filePath = $file->store('public/bookimages');
            $filename = str_replace('public/', '', $filePath);
            $book->book_image = $filename;
        }

        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $filePath = $file->store('public/bookfiles');
            $filename = str_replace('public/', '', $filePath);
            $book->book_file = $filename;
        }

        $book->update();

        return redirect()->back()->with('success', 'Book Updated Successfully!');
    }

    public function uploadCategory()
    {
        $categories = Category::all();
        return view('admin.frontend.upload_category')->with('categories', $categories);
    }

    public function postCategory(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required'
        ]);

        Category::create($validated);
        return redirect()->back()->with('success', 'Category created Successfully!');
    }
}
