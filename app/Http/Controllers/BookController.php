<?php

namespace App\Http\Controllers;

use TCPDF;
// use Spatie\PdfToText\Pdf;
use Spatie\PdfToImage\Pdf;
use App\Jobs\ProcessPdfConversion; // Новая задача для обработки PDF


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\BookMark;
use App\Models\Genre;
use App\Models\LinkBookGenre;
use App\Models\Publication;
use App\Models\Author;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $genre = Genre::all();
        $books = Book::paginate(6);
        return view('index', ["books" => $books, "genres" => $genre]);
    }

    public function newBooks()
    {
        $genre = Genre::all();
        $books = Book::orderBy('created_at', 'desc')->paginate(6);
        return view('index', ["books" => $books, "genres" => $genre]);
    }

    public function popularBooks()
    {
        $books = Book::leftJoin('comments', 'books.id', '=', 'comments.book_id')
            ->select('books.*', DB::raw('COUNT(comments.id) AS comments_count'))
            ->groupBy('books.id')
            ->orderBy('comments_count', 'desc')
            ->paginate(6);
        $genre = Genre::all();
        return view('index', ['books' => $books, "genres" => $genre]);
    }

    public function genreBooks($id)
    {
        $genres = Genre::all();
        $books = Genre::findOrFail($id)->books()->paginate(6);

        return view('index', compact('books', 'genres'));
    }

    public function authorsBooks($id){
        $genres = Genre::all();
        $books = Book::where('author_id',$id)->paginate(6);
        return view('index', compact('books', 'genres'));
    }

    public function bookProduct($id)
    {
        $subscriptions = Subscription::where('user_id',Auth::id())->get();
        $book = Book::find($id);
        $genre_links = LinkBookGenre::where('book_id', $id)->get();
        $genres = [];
    
        foreach ($genre_links as $genre_link) {
            $genre = Genre::find($genre_link->genre_id);
            if ($genre) {
                $genres[] = $genre;
            }
        }
    
        // Проверка аутентификации пользователя
        if (Auth::check()) {

            $bookMarks = Auth::user()->book_marks;
            $isBookMark = false;

            foreach ($bookMarks as $key => $value) {
                if ($value->book_id == $id) {
                    $isBookMark = true;
                    break; // Прерываю цикл, так как закладка уже найдена
                }
            }
        }
        return view(
            "bookProduct",
            [
                'book' => $book,
                'isBookMark' => (Auth::check() && $isBookMark),
                'genres' => $genres,
                'subscriptions' => $subscriptions
            ]
        );
    }

     public function readDocument($filename)
    {
        // Получите путь к PDF-файлу из хранилища
        $filePath = storage_path('app/public/document/' . $filename);
    
        // Проверьте существование файла
        if (!file_exists($filePath)) {
            abort(404); // Файл не найден
        }
    
        // Возвращаем представление с PDF-файлом
        return response()->file($filePath);
    }

    public function bookMarksCreate($id)
    {
        $book_id = Book::find($id);
        $user_id = Auth::user()->id;

        BookMark::create([
            'user_id' => $user_id,
            'book_id' => $book_id->id
        ]);
        return redirect("/");
    }

    public function bookMarksDelete($id)
    {
        $bookMark = BookMark::where([
            "user_id" => Auth::id(), "book_id" => $id
        ])->get("id");

        if ($bookMark) {
            BookMark::find($bookMark[0]->id)->delete();
        }

        return redirect("/");
    }


    // Деятельность админа
    // Издательства
    public function publicationCreate(Request $request)
    {
        $request->validate([
            'title_publications' => 'required|max:100',
        ], [
            'title_publications.required' => 'Поле "Издательство" обязательно для заполнения.',
            'title_publications.max' => 'Поле "Издательство" не должно превышать 100 символов.',
        ]);
        Publication::create([
            'title_publications' => $request['title_publications'],
        ]);
        return redirect("/admin/publications")->with("success",  "Вы успешно создали запись!");
    }
    public function publicationUpdate(Request $request)
    {
        $request->validate([
            'title_publications' => 'required|max:100',
        ], [
            'title_publications.required' => 'Поле "Издательство" обязательно для заполнения.',
            'title_publications.max' => 'Поле "Издательство" не должно превышать 100 символов.',
        ]);
        $publication = Publication::find($request['idPublication']);
        if ($publication->title_publications != $request['title_publications']) $publication->title_publications = $request['title_publications'];
        $publication->save();
        return redirect('/admin/publications')->with('success', 'Вы успешно отредактировали запись!');
    }
    public function publicationDelete($id)
    {
        $publication = Publication::find($id);

        if (!$publication) {
            return redirect('/admin/publications')->with('error', 'Запись не найдено.');
        }
        $publication->delete();

        return redirect('/admin/publications')->with('success', 'Вы успешно удалили запись!');
    }

    // Авторы
    public function authorDelete($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return redirect('/admin/authors')->with('error', 'Запись не найдено.');
        }
        $author->delete();

        return redirect('/admin/authors')->with('success', 'Вы успешно удалили запись!');
    }

    public function authorCreate(Request $request)
    {
        $request->validate(
            [
                'surname_author' => 'required|max:100',
                'name_author' => 'required|max:100',
            ],
            [
                'surname_author.required' => 'Поле "Фамилия автора" обязательно для заполнения.',
                'surname_author.max' => 'Поле "Фамилия автора" не должно превышать 100 символов.',
                'name_author.required' => 'Поле "Имя автора" обязательно для заполнения.',
                'name_author.max' => 'Поле "Имя автора" не должно превышать 100 символов.',
            ]
        );
        Author::create([
            'surname_author' => $request['surname_author'],
            'name_author' => $request['name_author'],
        ]);
        return redirect("/admin/authors")->with("success",  "Вы успешно создали запись!");
    }
    public function authorUpdate(Request $request)
    {
        $request->validate(
            [
                'surname_author' => 'required|max:100',
                'name_author' => 'required|max:100',
            ],
            [
                'surname_author.required' => 'Поле "Фамилия автора" обязательно для заполнения.',
                'surname_author.max' => 'Поле "Фамилия автора" не должно превышать 100 символов.',
                'name_author.required' => 'Поле "Имя автора" обязательно для заполнения.',
                'name_author.max' => 'Поле "Имя автора" не должно превышать 100 символов.',
            ]
        );
        $author = Author::find($request['idAuthor']);
        if ($author->surname_author != $request['surname_author']) $author->surname_author = $request['surname_author'];
        if ($author->name_author != $request['name_author']) $author->name_author = $request['name_author'];
        $author->save();
        return redirect('/admin/authors')->with('success', 'Вы успешно отредактировали запись!');
    }

    // Жанры
    public function genreDelete($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return redirect('/admin/genres')->with('error', 'Запись не найдена.');
        }
        $genre->delete();

        return redirect('/admin/genres')->with('success', 'Вы успешно удалили запись!');
    }

    public function genreCreate(Request $request)
    {
        $request->validate([
            'title_genre' => 'required|max:100',
            'description_genre' => 'required|max:500',
        ], [
            'title_genre.required' => 'Поле "Название жанра" обязательно для заполнения.',
            'title_genre.max' => 'Поле "Название жанра" не должно превышать 100 символов.',
            'description_genre.required' => 'Поле "Описание жанра" обязательно для заполнения.',
            'description_genre.max' => 'Поле "Описание жанра" не должно превышать 500 символов.',
        ]);
        Genre::create([
            'title_genre' => $request['title_genre'],
            'description_genre' => $request['description_genre'],
        ]);
        return redirect("/admin/genres")->with("success",  "Вы успешно создали запись!");
    }
    public function genreUpdate(Request $request)
    {
        $request->validate([
            'title_genre' => 'required|max:100',
            'description_genre' => 'required|max:500',
        ], [
            'title_genre.required' => 'Поле "Название жанра" обязательно для заполнения.',
            'title_genre.max' => 'Поле "Название жанра" не должно превышать 100 символов.',
            'description_genre.required' => 'Поле "Описание жанра" обязательно для заполнения.',
            'description_genre.max' => 'Поле "Описание жанра" не должно превышать 500 символов.',
        ]);
        $genre = Genre::find($request['idGenre']);
        // dd($genre);

        if ($genre->title_genre != $request['title_genre']) $genre->title_genre = $request['title_genre'];
        if ($genre->description_genre != $request['description_genre']) $genre->description_genre = $request['description_genre'];
        $genre->save();
        return redirect('/admin/genres')->with('success', 'Вы успешно отредактировали запись!');
    }

    // Катеории
    public function categoryDelete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect('/admin/categories')->with('error', 'Запись не найдена.');
        }
        $category->delete();

        return redirect('/admin/categories')->with('success', 'Вы успешно удалили запись!');
    }

    public function categoryCreate(Request $request)
    {
        $request->validate([
            'title_category' => 'required|max:100',
            'description_category' => 'required|max:500',
        ], [
            'title_category.required' => 'Поле "Название категории" обязательно для заполнения.',
            'title_category.max' => 'Поле "Название категории" не должно превышать 100 символов.',
            'description_category.required' => 'Поле "Описание категории" обязательно для заполнения.',
            'description_category.max' => 'Поле "Описание категории" не должно превышать 500 символов.',
        ]);
        Category::create([
            'title_category' => $request['title_category'],
            'description_category' => $request['description_category'],
        ]);
        return redirect("/admin/categories")->with("success",  "Вы успешно создали запись!");
    }
    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'title_category' => 'required|max:100',
            'description_category' => 'required|max:500',
        ], [
            'title_category.required' => 'Поле "Название категории" обязательно для заполнения.',
            'title_category.max' => 'Поле "Название категории" не должно превышать 100 символов.',
            'description_category.required' => 'Поле "Описание категории" обязательно для заполнения.',
            'description_category.max' => 'Поле "Описание категории" не должно превышать 500 символов.',
        ]);
        $category = Category::find($request['idCategory']);
        // dd($genre);

        if ($category->title_category != $request['title_category']) $category->title_category = $request['title_category'];
        if ($category->description_category != $request['description_category']) $category->description_category = $request['description_category'];
        $category->save();
        return redirect('/admin/categories')->with('success', 'Вы успешно отредактировали запись!');
    }
}
