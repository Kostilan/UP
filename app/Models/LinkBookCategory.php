<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Book;

class LinkBookCategory extends Model
{

    protected $fillable = [
        'book_id',
        'category_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
