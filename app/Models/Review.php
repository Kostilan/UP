<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\User;

class Review extends Model
{
    protected $fillable = [
        'evaluation',
        'review_text',
        'user_id',
        'book_id',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
