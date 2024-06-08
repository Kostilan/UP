@extends('layouts.app')

@section('title', 'Страница книги')

@section('content')
<section class="book-container">
    <img src="{{ asset('storage/photo/' . $book->photo) }}" alt="Книга">
    <div class="container-fluid">
        <p class="book-text-name">{{ $book->title_book }}</p>
        <p class="">Автор: <a href="{{ route('authorsBooks', ['id' => $book->author->id]) }}">{{ $book->author->surname_author }} {{ $book->author->name_author }}</a></p>
        <div class="book-container">
            <span class="book-evaluation"> {{ number_format($book->comments->avg('evaluation'), 1) }} &#9733; <br>
                <p class="text-dark text-center opacity-75 fs-5">{{ $book->comments->count() }}</p>
            </span>
        </div>
        <div class="">
            @auth
                <a href="{{ route('readDocument', ['filename' => $book->document, 'id' => $book->id]) }}">
                    <div class="book-block fs-6 me-3">Читать</div>
                </a>
                @if($note)
                <a href="{{ route('continue_reading', ['id' => $book->id]) }}">
                    <div class="book-block fs-6 me-3">Продолжить чтение</div>
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
            @endauth
            <section class="">
                <p>Объем: {{ $book->pages }} стр.</p>
            </section>
            <p class="fw-bold">Жанры: @foreach ($genres as $item)
                <a class="link-dark" href="{{ route('genreBooks', ['id' => $item->id]) }}">{{ $item->title_genre }}</a>
            @endforeach
            </p>
            <p class="fw-bold">Категории: @foreach ($categories as $item)
                <a class="link-dark" href="{{ route('categoryBooks', ['id' => $item->id]) }}">{{ $item->title_category }}</a>
            @endforeach
            </p>
            <section class="w-75">
                <span class="fw-bold fs-6">Описание книги: </span>
                <p>{{ $book->description }}</p>
            </section>
        </div>
    </section>
    <h2 class="comment-title">Отзывы</h2>
    <div class="content-wrapper">
        @foreach ($comments as $comment)
            <div class="comment-container">
                <div class="comment-evaluation">
                    @switch($comment->evaluation)
                        @case(1)
                            <p class="book-evaluation">&#9733</p>
                            <p class="evaluation-text"> Ужасно!</p>
                        @break
                        @case(2)
                            <p class="book-evaluation">&#9733&#9733</p>
                            <p class="evaluation-text"> Плохо</p>
                        @break
                        @case(3)
                            <p class="book-evaluation">&#9733&#9733&#9733</p>
                            <p class="evaluation-text"> Приемлимо</p>
                        @break
                        @case(4)
                            <p class="book-evaluation">&#9733&#9733&#9733&#9733</p>
                            <p class="evaluation-text"> Хорошо!</p>
                        @break
                        @case(5)
                            <p class="book-evaluation">&#9733&#9733&#9733&#9733&#9733</p>
                            <p class="evaluation-text"> Отлично!</p>
                        @break
                        @default
                    @endswitch()
                </div>
                <p class="comment-date">Опубликовано {{ \Carbon\Carbon::parse($comment->updated_at)->format('d.m.Y H:i') }} Пользователем {{ $comment->user->login }}</p>
                <p class="comment-text">{{ $comment->comment_text }}</p>
            </div>
        @endforeach
    </div>
    <div class="pagination">{{ $comments->links('vendor/pagination/custom') }}</div>
    @auth
        @if ($userComment && $userComment->user_id == Auth::id() && $userComment->book_id == $book->id)
            <div class="comment-form">
                <h3 class="">Обновить комментарий</h3>
                <form action="/bookProduct/commentUpdate/{{ $userComment->id }}" method="post">
                    @csrf
                    <div class="form-div">
                        <label for="update-comment-text" class="form-label">Текст отзыва:</label>
                        <textarea class="form-input-comment" id="update-comment-text" name="comment_text" rows="10">{{ $userComment->comment_text }}</textarea>
                        @error('comment_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-div">
                        <label for="update-comment-rating" class="form-label">Оценка:</label>
                        <input type="number" class="form-input-comment" id="update-comment-rating" name="evaluation" min="1" max="5" value="{{ $userComment->evaluation }}">
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
                        <textarea class="form-input-comment" id="comment-text" name="comment_text" rows="10"></textarea>
                        @error('comment_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-div">
                        <label for="comment-rating" class="form-label">Оценка:</label>
                        <input type="number" class="form-input-comment" id="comment-rating" name="evaluation" min="1" max="5">
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
@endsection
