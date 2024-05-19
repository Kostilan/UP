<h1>Мои закладки</h1>
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
                        <p class="opacity-75">{{ $book->author->surname_author }} {{ $book->author->name_author }}</p>
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
                    <a href="{{ url('bookProduct', $book->id) }}" class="btn btn-primary">Подробнее</a>
                </div>
            @endforeach
        </div>
    @endforeach

    <div class="pagination">
        {{ $books->links('vendor/pagination/custom') }}
    </div>
</div>
