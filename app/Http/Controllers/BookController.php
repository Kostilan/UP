<?php

namespace App\Http\Controllers;

use TCPDF;
// use Spatie\PdfToText\Pdf;
// use Spatie\PdfToImage\Pdf;
use App\Jobs\ProcessPdfConversion;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\BookMark;
use App\Models\Genre;
use App\Models\LinkBookGenre;
use App\Models\Publication;
use App\Models\Author;
use App\Models\Category;
use App\Models\LinkBookCategory;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
// use PDF;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\Fpdf;
use Smalot\PdfParser\Parser;
use Illuminate\Pagination\LengthAwarePaginator;

class BookController extends Controller
{
    // public function viewPdf($id)
    // {
    //     $book = Book::findOrFail($id);
    //     $pdfPath = storage_path('app/public/document/' . $book->document);

    //     // Создаем объект парсера PDF
    //     $parser = new Parser();
    //     // Получаем объект PDF
    //     $pdf = $parser->parseFile($pdfPath);

    //     // Извлекаем текст со всех страниц PDF
    //     $pdfText = '';
    //     foreach ($pdf->getPages() as $page) {
    //         $pdfText .= $page->getText();
    //     }

    //     return view('pdf', compact('pdfText'));
    // }

    public function index()
    {
        $genres = Genre::all();
        $categories = Category::all();
        $books = Book::with(['author', 'genres', 'categories'])->paginate(6);
    
        return view('index', [
            'books' => $books,
            'genres' => $genres,
            'categories' => $categories,
        ]);
    }

    public function newBooks()
    {
        $category = Category::all();
        $genre = Genre::all();
        $books = Book::orderBy('created_at', 'desc')->with(['author', 'genres', 'categories'])->paginate(6);
        return view('books', ["books" => $books, "genres" => $genre, "categories" => $category]);
    }

    public function popularBooks()
    {
        $books = Book::leftJoin('comments', 'books.id', '=', 'comments.book_id')
            ->select('books.*', DB::raw('COUNT(comments.id) AS comments_count'))
            ->groupBy('books.id')
            ->orderBy('comments_count', 'desc')->with(['author', 'genres', 'categories'])
            ->paginate(6);
        $genre = Genre::all();
        $category = Category::all();
        return view('books', ['books' => $books, "genres" => $genre,  "categories" => $category]);
    }

    public function genreBooks($id)
    {
        $categories = Category::all();
        $genres = Genre::all();
        $books = Genre::findOrFail($id)->books()->with(['author', 'genres', 'categories'])->paginate(6);

        return view('books', compact('books', 'genres', 'categories'));
    }

    public function categoryBooks($id)
    {
        $genres = Genre::all();
        $categories = Category::all();
        $books = Category::findOrFail($id)->books()->with(['author', 'genres', 'categories'])->paginate(6);

        return view('books', compact('books', 'categories', 'genres'));
    }

    public function authorsBooks($id)
    {
        $categories = Category::all();
        $genres = Genre::all();
        $books = Book::where('author_id', $id)->with(['author', 'genres', 'categories'])->paginate(6);
        return view('books', compact('books', 'categories', 'genres'));
    }

    public function bookProduct($id)
    {
        $subscriptions = Subscription::where('user_id', Auth::id())->get();
        $book = Book::find($id);
        $genre_links = LinkBookGenre::where('book_id', $id)->get();
        $category_links = LinkBookCategory::where('book_id', $id)->get();
        $genres = [];
        foreach ($genre_links as $genre_link) {
            $genre = Genre::find($genre_link->genre_id);
            if ($genre) {
                $genres[] = $genre;
            }
        }
        $categories = [];
        foreach ($category_links as $category_link) {
            $category = Category::find($category_link->category_id);
            if ($category) {
                $categories[] = $category;
            }
        }
        if (Auth::check()) {

            $bookMarks = Auth::user()->book_marks;
            $isBookMark = false;

            foreach ($bookMarks as $key => $value) {
                if ($value->book_id == $id) {
                    $isBookMark = true;
                    break;
                }
            }
        }
        return view(
            "bookProduct",
            [
                'book' => $book,
                'isBookMark' => (Auth::check() && $isBookMark),
                'genres' => $genres,
                'categories' => $categories,
                'subscriptions' => $subscriptions
            ]
        );
    }


    public function readDocument($filename, Request $request)
    {
        // Получите путь к PDF-файлу из хранилища
        $filePath = storage_path('app/public/document/' . $filename);

        // Проверьте существование файла
        if (!file_exists($filePath)) {
            abort(404); // Файл не найден
        }

        // Извлеките текст из PDF-файла
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($filePath);
        $text = $pdf->getText();

        // Очистка и форматирование текста
        $text = $this->cleanAndFormatText($text);

        // Разделите текст на части (например, по 2000 символов)
        $chunkSize = 2500;
        $chunks = str_split($text, $chunkSize);

        // Получите текущую страницу из запроса
        $page = $request->input('page', 1);

        // Определите общее количество страниц
        $totalPages = count($chunks);

        // Убедитесь, что текущая страница не выходит за пределы
        if ($page > $totalPages) {
            $page = $totalPages;
        } elseif ($page < 1) {
            $page = 1;
        }

        // Извлеките текущую часть текста
        $currentChunk = $chunks[$page - 1] ?? '';

        // Верните представление с текущей частью текста и информацией о пагинации
        return view('pdf', [
            'currentChunk' => $currentChunk,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    private function cleanAndFormatText($text)
    {
        // Удаление лишних пробелов
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);

        // Замена специальных символов новой строки на HTML <br>
        $text = nl2br($text);

        // Можно добавить дополнительные шаги по очистке и форматированию текста

        return $text;
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
