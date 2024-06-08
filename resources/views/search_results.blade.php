@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="container">
            <h2>Результаты поиска</h2>
        <div class="container-flex">
            <div class="list-catalog">
                @if ($books->count())
                    @foreach ($books->chunk(3) as $chunkedBooks)
                        <div class="book-list mb-5">
                            @foreach ($chunkedBooks as $book)
                                <div class="book">
                                    <div class="book-inner">
                                        <a href="{{ url('bookProduct', $book->id) }}">
                                            <img class="main-book-img" src="{{ asset('storage/photo/' . $book->photo) }}"
                                                alt="{{ $book->title_book }}">
                                        </a>
                                        <div class="book-info">
                                            <a class="link-dark" href="{{ url('bookProduct', $book->id) }}">
                                                <p>{{ $book->title_book }}</p>
                                                <p class="opacity-75">{{ $book->author->surname_author }}
                                                    {{ $book->author->name_author }}</p>
                                            </a>
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
                                            <a href="{{ url('bookProduct', $book->id) }}"
                                                class="btn btn-primary">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="pagination">
                        {{ $books->links('vendor/pagination/custom') }}
                    </div>
                @else
                    <p>Книги не найдены.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
