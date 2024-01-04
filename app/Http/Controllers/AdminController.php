<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Publication;
use App\Models\Author;


class AdminController extends Controller
{
    // Книги
    public function admin(){
        $books = Book::paginate(6);
        return view('admin.books', ["books"=>$books,]);
    }
    public function bookCreate(){
        return view('admin.publicationCreate');
    }
    public function bookUpdate($id){
        $publication = Publication::find($id);
        return view('admin.publicationsUpdate', compact('publication'));
    }

// Издательства
    public function publications(){
        $publications = Publication::all();
        return view('admin.publications', compact('publications'));
    }

    public function publicationsCreate(){
        return view('admin.publicationCreate');
    }
    public function publicationsUpdate($id){
        $publication = Publication::find($id);
        return view('admin.publicationsUpdate', compact('publication'));
    }

    // Авторы
    public function authors(){
        $authors = Author::all();
        return view('admin.authors', compact('authors'));
    }
    public function authorsCreate(){
        return view('admin.authorCreate');
    }
    public function authorsUpdate($id){
        $author = Author::find($id);
        return view('admin.authorUpdate', compact('author'));
    }

    // Жанры
    public function genres(){
        $genres = Genre::all();
        return view('admin.genres', compact('genres'));
    }
    public function genresCreate(){
        return view('admin.genreCreate');
    }
    public function genresUpdate($id){
        $genre = Genre::find($id);
        return view('admin.genreUpdate', compact('genre'));
    }

        // Категории
        public function categories(){
            $categories = Category::all();
            return view('admin.categories', compact('categories'));
        }
        public function categoriesCreate(){
            return view('admin.categoryCreate');
        }
        public function categoriesUpdate($id){
            $genre = Category::find($id);
            return view('admin.categoryUpdate', compact('genre'));
        }
}
