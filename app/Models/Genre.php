<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Genre extends Model
{
    protected $fillable = [
        'title_genre',
        'description_genre',
    ];
    
    public function book(){
        return $this->belongsToMany(Book::class);
    }
}
