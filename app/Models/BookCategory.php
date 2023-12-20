<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    protected $fillable = [
        'surname_author',
        'name_author',
    ];

    public $timestamps = false;
    
}
