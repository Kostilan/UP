@extends('layouts.app')

@section('title', 'Страница книги')

@section('content')
    <section class="book-container">
        <img src="{{ asset('storage/photo/' . $book->photo) }}" alt="Книга">
        <div class="container-fluid">
            <p class="book-text-name">
                {{ $book->title_book }}
            </p>
            <p class="">Автор: <a
                    href="{{ route('authorsBooks', ['id' => $book->author->id]) }}">{{ $book->author->surname_author }}
                    {{ $book->author->name_author }}</a></p>
            <div class="book-container">
                <span class="book-evaluation"> {{ number_format($book->comments->avg('evaluation'), 1) }} &#9733; <br>
                    <p class="text-dark text-center opacity-75 fs-5">{{ $book->comments->count() }}</p>
                </span>
                <span class="book-divider-line"></span>
                <span class="text-primary-emphasis fs-4">{{ count($book->review) }} &#9993; <a
                        href="{{ route('reviewCreate', ['id' => $book->id]) }}">+</a><br>
                    <p class="text-dark opacity-75 fs-5">Рецензии</p>

                </span>
            </div>
            <div class="">
                @auth
                    @if ($subscriptions)
                        {{-- <a href="{{ route('readDocument', ['filename' => $book->document]) }}"> --}}
                        <a href="{{ route('readDocument', ['filename' => $book->document]) }}">
                            <div class="book-block fs-6 me-3">Читать полностью</div>
                        </a>
                    @else
                        <a href="{{ route('readDocument', ['filename' => $book->document]) }}">
                            <div class="book-block fs-6 me-3">Читать фрагмент</div>
                        </a>
                    @endif
                    @if (!$isBookMark)
                        <a href="/bookProduct/bookMarks/{{ $book->id }}">
                            <div class="book-block fs-6">Добавить в Избранное &#10084;</div>
                        </a>
                    @else
                        <a href="/bookProduct/bookMarks/{{ $book->id }}/delete">
                            <div class="book-block fs-6">Удалить из Избранного &#10084;</div>
                        </a>
                    @endif
                </div>
            @endauth
            <section class="">

                <p>Объем: {{ $book->pages }} стр.</p>
            </section>
            <p class="fw-bold">Жанры: @foreach ($genres as $item)
                    <a class="link-dark"
                        href="{{ route('genreBooks', ['id' => $item->id]) }}">{{ $item->title_genre }}</a>
                @endforeach
            </p>
            <p class="fw-bold">Категории: @foreach ($categories as $item)
                    <a class="link-dark"
                        href="{{ route('categoryBooks', ['id' => $item->id]) }}">{{ $item->title_category }}</a>
                @endforeach
            </p>
            <section class=" w-75">
                <span class="fw-bold fs-6">Описание книги: </span>
                <p>{{ $book->description }}</p>
            </section>
        </div>
    </section>

    <h2 class="comment-title">Отзывы</h2>
    <div class="">
        @foreach ($book->comments as $comment)
            <div class="comment-container">
                <p class="comment-text">{{ $comment->comment_text }}</p>
                <p class="comment-text">Оценка: {{ $comment->evaluation }}</p>
                <p class="comment-text">Пользователь: {{ $comment->user->login }}</p>
            </div>
        @endforeach


        @auth
            @if (isset($comment) && $comment->user_id == Auth::id() && $comment->book_id == $book->id)
                <div class="comment-form">
                    <h3 class="">Обновить комментарий</h3>

                    <form action="/bookProduct/commentUpdate/{{ $comment->id }}" method="post">
                        @csrf
                        <div class="form-div">
                            <label for="update-comment-text" class="form-label">Текст отзыва:</label>
                            <textarea class="form-input" id="update-comment-text" name="comment_text">{{ $comment->comment_text }}</textarea>
                            @error('comment_text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="update-comment-rating" class="form-label">Оценка:</label>
                            <input type="number" class="form-input" id="update-comment-rating" name="evaluation" min="1"
                                max="5" value="{{ $comment->evaluation }}">
                            @error('evaluation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить отзыв</button>
                    </form>
                </div>
            @else
                <div class="comment-form">
                    <h3 class="">Добавить комментарий</h3>
                    <form action="/bookProduct/commentCreate" method="post">
                        @csrf
                        <div class="form-div">
                            <label for="comment-text" class="form-label">Текст отзыва:</label>
                            <textarea class="form-input" id="comment-text" name="comment_text"></textarea>
                            @error('comment_text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-div">
                            <label for="comment-rating" class="form-label">Оценка:</label>
                            <input type="number" class="form-input" id="comment-rating" name="evaluation" min="1"
                                max="5">
                            @error('evaluation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <button type="submit" class="btn btn-primary">Оставить отзыв</button>
                    </form>
                </div>
            @endif


        @endauth
    </div>
@endsection
