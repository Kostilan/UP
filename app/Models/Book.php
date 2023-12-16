<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publication;
use App\Models\BookCategory;

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
        return $this->belongsToMnay(BookCategory::class);
    }
    public function publication(){
        return $this->belongsTo(Publication::class);
    }
  
}
