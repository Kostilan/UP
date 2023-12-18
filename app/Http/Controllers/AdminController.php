<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Genre;
use App\Models\BookCategory;
use App\Models\Publication;


class AdminController extends Controller
{
    public function books(){
        

        return view('books');
    }
}
