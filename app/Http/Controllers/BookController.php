<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\BookMark;
use App\Models\Genre;

class BookController extends Controller
{
    public function index(){
        $genre = Genre::all();
        $books = Book::paginate(6);
        return view('index', ["books"=>$books, "genres"=>$genre]);
    }

    public function newBooks(){
        $genre = Genre::all();
        $books = Book::orderBy('created_at', 'desc')->paginate(6);
        return view('index', ["books"=>$books, "genres"=>$genre]);
    }

        public function bookProduct($id){
            $book = Book::find($id);

            // Проверка аутентификации пользователя
        if (Auth::check()) {
            $bookMarks = Auth::user()->book_marks;
            $isBookMark = false;

            foreach ($bookMarks as $key => $value) {
                if($value->book_id == $id) {
                    $isBookMark = true;
                    break; // Прерываю цикл, так как закладка уже найдена
                }
            }
        }
            return view("bookProduct",
            [
                'book' => $book,
                'isBookMark' => (Auth::check() && $isBookMark)
            ]
            );
        }

        public function bookMarksCreate($id){
            $book_id = Book::find($id);
            $user_id = Auth::user()->id;

            BookMark::create([
                'user_id' => $user_id,
                'book_id' => $book_id->id
            ]);
            return redirect("/");
        }

        public function bookMarksDelete($id){
            $bookMark = BookMark::where([
                "user_id"=> Auth::id(), "book_id" => $id
            ])->get("id");

            if($bookMark){BookMark::find($bookMark[0]->id)->delete();}
            
            return redirect("/");
        }

  
}
