@extends('layouts.app')

@section('title', 'Избранное')

@section('content')
    <main class="container-flex">
        <div class="genre-left">
            <div class="genre ">
                <ul class="genre-list">
                    <li class="list-group-item">
                        <h3>Аккаунт</h3>
                    </li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light" href="/account">Обо
                            мне</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="/account/accountBookMarks">Избранное</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountComments') }}">Мои комментарии</a></li>
                    <li class="list-group-item"><a id="" class="link-dark link-underline-light"
                            href="{{ route('accountRead') }}">Я читаю</a></li>
                </ul>
            </div>
        </div>
        <div id="" class="container">
            <h1>Избранное</h1>
            <div class="list-catalog container-fluid">
                @foreach ($books->chunk(3) as $chunkedBooks)
                    <div class="d-flex book-list">
                        @foreach ($chunkedBooks as $book)
                            <div class="  book-account_marks book">
                                <a href="{{ url('bookProduct', $book->id) }}">
                                    <img class="main-book-img" src="{{ asset('storage/photo/' . $book->photo) }}"
                                        alt="{{ $book->title_book }}">
                                </a>
                                <a class="link-dark link-underline-opacity-0" href="{{ url('bookProduct', $book->id) }}">
                                    <p>{{ $book->title_book }}</p>
                                </a>
                                <p class="">Автор: <a
                                        href="{{ route('authorsBooks', ['id' => $book->author->id]) }}">{{ $book->author->surname_author }}
                                        {{ $book->author->name_author }}</a></p>
                                <p class="fw-bold">Жанры:
                                    @foreach ($book->genres as $item)
                                        <a class="link-dark"
                                            href="{{ route('genreBooks', ['id' => $item->id]) }}">{{ $item->title_genre }}</a>
                                    @endforeach
                                </p>
                                <p class="fw-bold">Категории:
                                    @foreach ($book->categories as $item)
                                        <a class="link-dark"
                                            href="{{ route('categoryBooks', ['id' => $item->id]) }}">{{ $item->title_category }}</a>
                                    @endforeach
                                </p>
                                <a href="{{ url('bookProduct', $book->id) }}" class="btn btn-primary">Подробнее</a>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="pagination">
                    {{ $books->links('vendor/pagination/custom') }}
                </div>
            </div>
        </div>
    </main>
@endsection
