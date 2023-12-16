<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Author extends Model
{
    protected $fillable = [
        'surname_author',
        'name_author',
    ];

    public function book(){
        return $this->hasMany(Book::class);
    }

}
