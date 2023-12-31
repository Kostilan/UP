@extends('layouts.app-admin')

@section('title', 'Главная страница')

@section('content')
    <div class="">
        <h2>Список книг</h2>
        <div class="d-flex justify-content-between mb-3">
            <a class="btn btn-primary" href="/admin/books/create">Создать книгу</a>
           
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название книги</th>
                    <th>Автор</th>
                    <th>Обложка</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books->chunk(3) as $chunkedBooks)
                    @foreach ($chunkedBooks as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>
                                <a href="{{ url('bookProduct', $book->id) }}">
                                    {{ $book->title_book }}
                                </a>
                            </td>
                            <td>
                                {{ $book->author->surname_author }} {{ $book->author->name_author }}
                            </td>
                            <td>
                                <a href="{{ url('bookProduct', $book->id) }}">
                                    <img class="main-book-img" src="{{ $book->photo }}" alt="{{ $book->title_book }}">
                                </a>
                            </td>
                            <td>
                                <a href="/admin/books/edit/{{ $book->id }}" class="btn btn-warning">Редактировать</a>
                                <form action="/admin/books/delete/{{ $book->id }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $books->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
