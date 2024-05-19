<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publication;
use App\Models\Category;
use App\Models\Review;
use App\Models\Comment;
use App\Models\LinkBookGenre;

class Book extends Model
{
    protected $fillable = [
        'title_book',
        'photo',
        'document',
        'author_id',
        'publication_id',
        'year_publication',
        'description',
        'auditorium',
        'pages',
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }
    public function category(){
        return $this->belongsToMnay(Category::class);
    }
    public function publication(){
        return $this->belongsTo(Publication::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'link_book_genre', 'book_id', 'genre_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'link_book_categories', 'book_id', 'category_id');
    }
  
}
