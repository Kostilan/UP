<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\BookMark;
use App\Models\Genre;
use App\Models\Publication;
use App\Models\Author;

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


        // Деятельность админа
        // Издательства
        public function publicationCreate(Request $request){
            $request->validate([
                'title_publications' => 'required|max:100',
            ]);
            Publication::create([
            'title_publications' => $request['title_publications'],
            ]);
            return redirect ("/admin/publications")->with("success",  "Вы успешно создали запись!");

        }
        public function publicationUpdate(Request $request){
            $request->validate([
                'title_publications' => 'required|max:100',
            ]);
            $publication = Publication::find($request['idPublication']);
            if($publication->title_publications != $request['title_publications']) $publication->title_publications = $request['title_publications'];
            $publication->save();
            return redirect('/admin/publications')->with('success', 'Вы успешно отредактировали запись!');
        }
        public function publicationDelete($id){
            $publication = Publication::find($id);

            if(!$publication){
                return redirect('/admin/publications')->with('error', 'Запись не найдено.');
            }
            $publication->delete();

            return redirect('/admin/publications')->with('success', 'Вы успешно удалили запись!');
        }

        // Авторы
        public function authorDelete($id){
            $author = Author::find($id);

            if(!$author){
                return redirect('/admin/authors')->with('error', 'Запись не найдено.');
            }
            $author->delete();

            return redirect('/admin/authors')->with('success', 'Вы успешно удалили запись!');
        }
  
        public function authorCreate(Request $request){
            $request->validate([
                'surname_author' => 'required|max:100',
                'name_author' => 'required|max:100',
            ]);
            Author::create([
            'surname_author' => $request['surname_author'],
            'name_author' => $request['name_author'],
            ]);
            return redirect ("/admin/authors")->with("success",  "Вы успешно создали запись!");

        }
        public function authorUpdate(Request $request){
            $request->validate([
                'surname_author' => 'required|max:100',
                'name_author' => 'required|max:100',
            ]);
            $author = Author::find($request['idAuthor']);
            if($author->surname_author != $request['surname_author']) $author->surname_author = $request['surname_author'];
            if($author->name_author != $request['name_author']) $author->name_author = $request['name_author'];
            $author->save();
            return redirect('/admin/authors')->with('success', 'Вы успешно отредактировали запись!');
        }

              // Жанры
              public function genreDelete($id){
                $genre = Genre::find($id);
    
                if(!$genre){
                    return redirect('/admin/genres')->with('error', 'Запись не найдена.');
                }
                $genre->delete();
    
                return redirect('/admin/genres')->with('success', 'Вы успешно удалили запись!');
            }
      
            public function genreCreate(Request $request){
                $request->validate([
                    'surname_author' => 'required|max:100',
                    'name_author' => 'required|max:100',
                ]);
                Author::create([
                'surname_author' => $request['surname_author'],
                'name_author' => $request['name_author'],
                ]);
                return redirect ("/admin/authors")->with("success",  "Вы успешно создали запись!");
    
            }
            public function genreUpdate(Request $request){
                $request->validate([
                    'surname_author' => 'required|max:100',
                    'name_author' => 'required|max:100',
                ]);
                $author = Author::find($request['idAuthor']);
                if($author->surname_author != $request['surname_author']) $author->surname_author = $request['surname_author'];
                if($author->name_author != $request['name_author']) $author->name_author = $request['name_author'];
                $author->save();
                return redirect('/admin/authors')->with('success', 'Вы успешно отредактировали запись!');
            }
}
