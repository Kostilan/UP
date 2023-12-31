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

class Book extends Model
{
    protected $fillable = [
        'title_book',
        'photo',
        'author_id',
        'publication_id ',
        'year_publication',
        'description',
        'auditorium',
        'pages',
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }
    public function genre(){
        return $this->belongsToMany(Genre::class);
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
  
}
