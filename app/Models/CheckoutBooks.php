<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutBooks extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'checkout_id'];

    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function checkouts()
    {
        return $this->belongsTo(Checkout::class);
    }
}
