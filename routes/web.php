<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use App\Service\BookService;
use Carbon\Translator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

include __DIR__ . '/admin.php';

Route::get('/', function (BookService $bookService) {
    //Testing Mixins
    // $array = ['ben', 'jack', 'john', 'nick', 'tom', 'john'];
    // dd(collect($array)->duplicateCheck('john'));

    // $books = Book::all();
    $books = $bookService->getAllBooks();
    return view('welcome')->with('books', $books);
})->name('welcome');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'homepage'])->name('user.homepage');
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/library', [UserController::class, 'library'])->name('user.library');

    //Put to Cart
    Route::get('/user/cart', [UserController::class, 'userCart'])->name('user.cart');
    Route::post('/user/checkout', [UserController::class, 'userCheckout'])->name('user.checkout');

    //PDF Functions
    Route::get('/user/view/{book_id}', [UserController::class, 'viewPdf'])->name('view.pdf');
    Route::get('/user/download/{book_id}', [UserController::class, 'downloadPdf'])->name('download.pdf');
});

Route::middleware('auth')->group(function () {
    //Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Post Detail Routes
    Route::get('/books/bookdetail/{book}', [BookController::class, 'bookDetail'])->name('books.bookdetail');

    Route::post('/books/cart/put/{book}', [BookController::class, 'putCart'])->name('books.putCart');
    Route::delete('/books/cart/remove/{book}', [BookController::class, 'removeCart'])->name('books.removeCart');
});

require __DIR__ . '/auth.php';
