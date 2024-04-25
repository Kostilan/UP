<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\LinkBookGenre;

class Genre extends Model
{
    protected $fillable = [
        'title_genre',
        'description_genre',
    ];
    
    public function books()
    {
        return $this->belongsToMany(Book::class, 'link_book_genre', 'genre_id', 'book_id');
    }
    public $timestamps = false;

}
