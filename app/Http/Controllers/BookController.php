<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    public function index(){
        $genre = Genre::all();
        $books = Book::paginate(9);
        return view('index', ["books"=>$books, "genres"=>$genre]);
    }
    public function bookProduct($id){
        $book = Book::find($id);
        return view("bookProduct",
        compact("book")
        );
    }

  
}
