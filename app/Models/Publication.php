<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Publication extends Model
{
    protected $fillable = [
        'surname_author',
        'name_author',
    ];

    public function book(){
        $this->hasMany(Book::class);
    }
}
