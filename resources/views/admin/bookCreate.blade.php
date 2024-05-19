@extends('layouts.app')

@section('title', 'Создание книги')

@section('content')

    <div class="container">
        <h2>Редактирование книги</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('bookCreate_valid') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-div">
                <label for="title_book" class="form-label">Название книги:</label>
                <input type="text" class="form-input" id="title_book" name="title_book" required>
                @error('title_book')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-div">
                <label for="photo" class="form-label">Фото:</label>
                <input type="file" class="form-input" id="photo" name="photo" required>
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-div">
                <label for="document" class="form-label">Документ (PDF):</label>
                <input type="file" class="form-input" id="document" name="document" required>
                @error('document')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-div">
                <label for="author_id" class="form-label">Автор:</label>
                <select class="form-input" id="author_id" name="author_id" required>
                    <option value="">Выберите автора</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->surname_author }} {{ $author->name_author }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-div">
                <label for="publication_id" class="form-label">Издание:</label>
                <select class="form-input" id="publication_id" name="publication_id" required>
                    <option value="">Выберите издание</option>
                    @foreach ($publications as $publication)
                        <option value="{{ $publication->id }}">{{ $publication->title_publications }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-div">
                <label for="year_publication" class="form-label">Год издания:</label>
                <input type="number" class="form-input" id="year_publication" name="year_publication" required>
                @error('year_publication')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-div">
                <label for="description" class="form-label">Описание:</label>
                <textarea class="form-input" id="description" name="description" rows="3" required></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-div">
                <label for="auditorium" class="form-label">Аудитория:</label>
                <input type="text" class="form-input" id="auditorium" name="auditorium" required>
                @error('auditorium')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-div">
                <label for="pages" class="form-label">Количество страниц:</label>
                <input type="number" class="form-input" id="pages" name="pages" required>
                @error('pages')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="container-select">
                <div class="form-div">
                    <label for="genres" class="form-label">Жанры:</label>
                    @foreach ($genres as $genre)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="genre_{{ $genre->id }}" name="genre_ids[]"
                                value="{{ $genre->id }}">
                            <label class="form-check-label" for="genre_{{ $genre->id }}">
                                {{ $genre->title_genre }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-div">
                    <label for="categories" class="form-label">Категории:</label>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="category_{{ $category->id }}" name="category_ids[]"
                                value="{{ $category->id }}">
                            <label class="form-check-label" for="category_{{ $category->id }}">
                                {{ $category->title_category }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Создать книгу</button>
        </form>
    </div>

@endsection
