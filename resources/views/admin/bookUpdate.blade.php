@extends('layouts.app')

@section('title', 'Редактирование книги')

@section('content')
    <div class="container">
        <h2>Редактирование книги</h2>

        @if (session('error'))
            <div class="alert alert-success mt-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
        <form action="{{ route('bookUpdatemin_valid', ['id' => $book->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-div">
                <label for="title_book" class="form-label">Название книги</label>
                <input type="text" class="form-input" id="title_book" name="title_book" value="{{ $book->title_book }}">
                @error('title_book')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            
            <div class="form-div">
                <label for="photo" class="form-label">Фото:</label>
                <input type="file" class="form-input" id="photo" name="photo" value="{{ $book->photo }}" required>
                @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-div">
                <label for="document" class="form-label">Документ (PDF):</label>
                <input type="file" class="form-input" id="document" value="{{ $book->document }}" name="document" required accept="application/pdf">
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
                <select class="form-input" id="publication_id"  name="publication_id" required>
                    <option value="">Выберите издание</option>
                    @foreach ($publications as $publication)
                        <option value="{{ $publication->id }}">{{ $publication->title_publications }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-div">
                <label for="year_publication" class="form-label">Год издания:</label>
                <input type="number" class="form-input" id="year_publication" value="{{ $book->year_publication }}" name="year_publication" required>
                @error('year_publication')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-div">
                <label for="description" class="form-label">Описание:</label>
                <textarea class="form-input" id="description" name="description" rows="3"  required>{{ $book->description }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-div">
                <label for="auditorium" class="form-label">Аудитория:</label>
                <input type="text" class="form-input" id="auditorium" value="{{ $book->auditorium }}" name="auditorium" required>
                @error('auditorium')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>

            <div class="form-div">
                <label for="pages" class="form-label">Количество страниц:</label>
                <input type="number" class="form-input" id="pages" value="{{ $book->pages }}" name="pages" required>
                @error('pages')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>


            <button type="submit" class="btn btn-primary">Обновить</button>
        </form>
    </div>
@endsection