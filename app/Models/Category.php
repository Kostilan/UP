<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\LinkBookCategory;


class Category extends Model
{
    protected $fillable = [
        'title_category',
        'description_category',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'link_book_categories', 'category_id', 'book_id');
    }
    public $timestamps = false;
    
}
