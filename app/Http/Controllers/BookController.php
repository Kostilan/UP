<?php

namespace App\Http\Controllers;

use TCPDF;
// use Spatie\PdfToText\Pdf;
// use Spatie\PdfToImage\Pdf;
use App\Jobs\ProcessPdfConversion;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\BookMark;
use App\Models\Note;
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
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Поиск по книгам, авторам, категориям и жанрам
        $books = Book::where('title_book', 'like', "%$query%")
            ->orWhereHas('author', function ($q) use ($query) {
                $q->where('name_author', 'like', "%$query%")
                    ->orWhere('surname_author', 'like', "%$query%");
            })
            ->orWhereHas('categories', function ($q) use ($query) {
                $q->where('title_category', 'like', "%$query%");
            })
            ->orWhereHas('genres', function ($q) use ($query) {
                $q->where('title_genre', 'like', "%$query%");
            })
            ->paginate(6);

        return view('search_results', compact('books'));
    }

    public function index()
    {
        $genres = Genre::all();
        $categories = Category::all();
        
        // Получение популярных авторов (авторы с наибольшим количеством книг)
        $popularAuthors = Author::withCount('book')
            ->orderBy('book_count', 'desc')
            ->paginate(3);
    
        // Получение книг популярных авторов (ограничено тремя книгами)
        $popularAuthorsBooks = Book::whereIn('author_id', $popularAuthors->pluck('id'))
            ->with(['author', 'genres', 'categories'])
            ->limit(3)
            ->get();
    
        $books = Book::with(['author', 'genres', 'categories'])->paginate(6);
    
        return view('index', [
            'books' => $books,
            'genres' => $genres,
            'categories' => $categories,
            'popularAuthorsBooks' => $popularAuthorsBooks,
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
        $book = Book::find($id);
        $note = Note::where('book_id',$id)->where('user_id',Auth::id())->first();
        $comments = $book->comments()->paginate(3);
        $userComment = $book->comments()->where('user_id', auth()->id())->first();
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
                'comments' => $comments,
                'userComment' => $userComment,
                'note' => $note
            ]
        );
    }

    public function addBookmark(Request $request)
    {
        $userId = Auth::id();
        $bookId = $request->input('book_id');
        $page = $request->input('page');
        $allPages = $request->input('all_pages'); // Получаем значение общего количества страниц
    
        Note::updateOrCreate(
            ['user_id' => $userId, 'book_id' => $bookId],
            ['page' => $page, 'all_pages' => $allPages] // Сохраняем как текущую страницу, так и общее количество страниц
        );
    
        return redirect()->back()->with('message', 'Закладка добавлена!');
    }

    public function readDocument($filename, Request $request, $id)
    {
        $filePath = storage_path('app/public/document/' . $filename);
    
        if (!file_exists($filePath)) {
            abort(404);
        }
    
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);
        $pages = $pdf->getPages();
    
        $textChunks = [];
        foreach ($pages as $page) {
            $textChunks[] = $page->getText();
        }
    
        $text = implode("\n\n", $textChunks);
        $text = $this->cleanAndFormatText($text);
    
        $chunkSize = 2500;
        $chunks = $this->splitTextIntoChunks($text, $chunkSize);
    
        $userId = Auth::id();
        $note = Note::where('user_id', $userId)->where('book_id', $id)->first();
    
        // Получаем значение page из запроса, если оно есть, иначе из закладки или по умолчанию 1
        $page = $request->input('page', $note ? $note->page : 1);
    
        $totalPages = count($chunks);
    
        if ($page > $totalPages) {
            $page = $totalPages;
        } elseif ($page < 1) {
            $page = 1;
        }
    
        $currentChunk = $chunks[$page - 1] ?? '';
    
        return view('pdf', [
            'currentChunk' => $currentChunk,
            'page' => $page,
            'totalPages' => $totalPages,
            'id' => $id
        ]);
    }

    public function continue_reading($id)
    {
        $userId = Auth::id();
        $note = Note::where('user_id', $userId)->where('book_id', $id)->first();
        
        if ($note) {
            $filename = Book::find($id)->document;
            $page = $note->page;
            // Отладочная информация
            Log::info('Continue reading for user', ['user_id' => $userId, 'book_id' => $id, 'page' => $page, 'filename' => $filename]);
    
            return redirect()->route('readDocument', ['filename' => $filename, 'id' => $id, 'page' => $page]);
        } else {
            $filename = Book::find($id)->document;
            // Отладочная информация
            Log::info('Continue reading for user with no bookmark', ['user_id' => $userId, 'book_id' => $id, 'filename' => $filename]);
    
            return redirect()->route('readDocument', ['filename' => $filename, 'id' => $id]);
        }
    }

    private function cleanAndFormatText($text)
    {
        // Удаление лишних пробелов
        $text = trim($text);

        // Разделение абзацев и диалогов
        $text = preg_replace('/\n\s*\n/', '</p><p>', $text); // Абзацы
        $text = preg_replace('/\n/', '<br>', $text); // Переносы строк внутри абзацев

        // Добавление тега абзаца в начало и конец текста
        $text = '<p>' . $text . '</p>';

        return $text;
    }

    private function splitTextIntoChunks($text, $chunkSize)
    {
        // Разделение текста на части с сохранением HTML-тегов
        $chunks = [];
        $offset = 0;
        while ($offset < strlen($text)) {
            $chunk = substr($text, $offset, $chunkSize);
            $lastSpace = strrpos($chunk, ' ');
            if ($lastSpace !== false && $offset + $chunkSize < strlen($text)) {
                $chunk = substr($chunk, 0, $lastSpace);
            }
            $chunks[] = $chunk;
            $offset += strlen($chunk);
        }
        return $chunks;
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
