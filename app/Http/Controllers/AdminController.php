<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Author;
use App\Models\LinkBookGenre;
use App\Models\LinkBookCategory;



class AdminController extends Controller
{
    // Книги
    public function admin()
    {
        $books = Book::paginate(6);
        return view('admin.books', ["books" => $books,]);
    }
    public function bookDelete($id)
    {
        // Найдем книгу по ее идентификатору
        $book = Book::findOrFail($id);


        $book->delete();


        return redirect()->back()->with('success', 'Книга успешно удалена');
    }

    function bookUpdate($id)
    {
        $authors = Author::all();
        $publications = Publication::all();
        $book = Book::find($id);
        $categories = Category::all();
        $genres = Genre::all();

        $bookGenreIds = $book->genres->pluck('id')->toArray();
        $bookCategoryIds = $book->categories->pluck('id')->toArray();

        return view('admin.bookUpdate', compact('book', 'authors', 'publications', 'categories', 'genres', 'bookGenreIds', 'bookCategoryIds'));
    }
    public function bookCreate()
    {
        $authors = Author::all();
        $publications = Publication::all();
        $categories = Category::all();
        $genres = Genre::all();
        return view('admin.bookCreate', compact('authors', 'publications', 'categories', 'genres'));
    }
    function bookCreate_valid(Request $request)
    {
        $request->validate([
            'title_book' => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:200',
            'document' => 'required|mimes:pdf',
            'author_id' => 'required|exists:authors,id',
            'publication_id' => 'required|exists:publications,id',
            'year_publication' => 'required|integer|min:1900|max:' . date('Y'),
            'description' => 'required|string',
            'auditorium' => 'required|string',
            'pages' => 'required|integer|min:1',
        ]);

        // Сохранение фото
        $photoPath = $request->file('photo')->store('public/photo');

        // Сохранение документа
        $documentPath = $request->file('document')->store('public/document');

        // Сохранение книги
        $book = Book::create([
            'title_book' => $request->title_book,
            'photo' => basename($photoPath),
            'document' => basename($documentPath),
            'author_id' => $request->author_id,
            'publication_id' => $request->publication_id,
            'year_publication' => $request->year_publication,
            'description' => $request->description,
            'auditorium' => $request->auditorium,
            'pages' => $request->pages,
        ]);

        // Сохранение связей с жанрами
        if ($request->has('genre_ids')) {
            foreach ($request->genre_ids as $genre_id) {
                LinkBookGenre::create([
                    'book_id' => $book->id,
                    'genre_id' => $genre_id,
                ]);
            }
        }

        // Сохранение связей с категориями
        if ($request->has('category_ids')) {
            foreach ($request->category_ids as $category_id) {
                LinkBookCategory::create([
                    'book_id' => $book->id,
                    'category_id' => $category_id,
                ]);
            }
        }

        return redirect('admin')->with('success', 'Книга успешно создана.');
    }

    function bookUpdatemin_valid($id, Request $request)
    {
        // Найдем книгу по ее идентификатору
        $book = Book::findOrFail($id);

        // Проверим валидность входных данных
        $request->validate([
            'title_book' => 'required|string|max:255',
            'photo' => 'image|mimes:jpeg,png,jpg,gif', 
            'document' => 'mimes:pdf',
            'author_id' => 'required|exists:authors,id',
            'publication_id' => 'required|exists:publications,id',
            'year_publication' => 'required|integer',
            'description' => 'required|string',
            'auditorium' => 'required|string|max:255',
            'pages' => 'required|integer',
        ]);

        // Обновим данные книги
        $book->update([
            'title_book' => $request->title_book,
            'author_id' => $request->author_id,
            'publication_id' => $request->publication_id,
            'year_publication' => $request->year_publication,
            'description' => $request->description,
            'auditorium' => $request->auditorium,
            'pages' => $request->pages,
        ]);

        // Если загружено новое изображение, сохраните его
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('public/photo', $fileName);
            $book->photo = $fileName;
            $book->save();
        }

        // Если загружен новый документ PDF, сохраните его
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $fileName = time() . '_' . $document->getClientOriginalName();
            $document->storeAs('public/document', $fileName);
            $book->document = $fileName;
            $book->save();
        }

        // Обновим связи с жанрами
        $book->genres()->sync($request->genres ?? []);

        // Обновим связи с категориями
        $book->categories()->sync($request->categories ?? []);

        return redirect()->route('admin', $book->id)->with('success', 'Книга успешно обновлена');
    }




    // Издательства
    public function publications()
    {
        $publications = Publication::paginate(5);
        return view('admin.publications', compact('publications'));
    }

    public function publicationsCreate()
    {
        return view('admin.publicationCreate');
    }
    public function publicationsUpdate($id)
    {
        $publication = Publication::find($id);
        return view('admin.publicationsUpdate', compact('publication'));
    }

    // Авторы
    public function authors()
    {
        $authors = Author::paginate(5);
        return view('admin.authors', compact('authors'));
    }
    public function authorsCreate()
    {
        return view('admin.authorCreate');
    }
    public function authorsUpdate($id)
    {
        $author = Author::find($id);
        return view('admin.authorUpdate', compact('author'));
    }

    // Жанры
    public function genres()
    {
        $genres = Genre::paginate(5);
        return view('admin.genres', compact('genres'));
    }
    public function genresCreate()
    {
        return view('admin.genreCreate');
    }
    public function genresUpdate($id)
    {
        $genre = Genre::find($id);
        return view('admin.genreUpdate', compact('genre'));
    }

    // Категории
    public function categories()
    {
        $categories = Category::paginate(5);
        return view('admin.categories', compact('categories'));
    }
    public function categoriesCreate()
    {
        return view('admin.categoryCreate');
    }
    public function categoriesUpdate($id)
    {
        $genre = Category::find($id);
        return view('admin.categoryUpdate', compact('genre'));
    }
}
