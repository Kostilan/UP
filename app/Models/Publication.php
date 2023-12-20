<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Publication extends Model
{
    protected $fillable = [
        'title_publications',
    ];

    public function book(){
        $this->hasMany(Book::class);
    }
    public $timestamps = false;

}
